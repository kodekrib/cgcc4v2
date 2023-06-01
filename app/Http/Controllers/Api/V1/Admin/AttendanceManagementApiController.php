<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAttendanceManagementRequest;
use App\Http\Requests\UpdateAttendanceManagementRequest;
use App\Http\Resources\Admin\AttendanceManagementResource;
use App\Models\AttendanceManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendanceManagementApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('attendance_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendanceManagementResource(AttendanceManagement::with(['meeting_type', 'meeting_title', 'members_in_attendances', 'created_by', 'cih_centre'])->get());
    }

    public function store(StoreAttendanceManagementRequest $request)
    {
        $attendanceManagement = AttendanceManagement::create($request->all());
        $attendanceManagement->members_in_attendances()->sync($request->input('members_in_attendances', []));
        foreach ($request->input('external_files', []) as $file) {
            $attendanceManagement->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_files');
        }

        return (new AttendanceManagementResource($attendanceManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AttendanceManagement $attendanceManagement)
    {
        abort_if(Gate::denies('attendance_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendanceManagementResource($attendanceManagement->load(['meeting_type', 'meeting_title', 'members_in_attendances', 'created_by', 'cih_centre']));
    }

    public function update(UpdateAttendanceManagementRequest $request, AttendanceManagement $attendanceManagement)
    {
        $attendanceManagement->update($request->all());
        $attendanceManagement->members_in_attendances()->sync($request->input('members_in_attendances', []));
        if (count($attendanceManagement->external_files) > 0) {
            foreach ($attendanceManagement->external_files as $media) {
                if (!in_array($media->file_name, $request->input('external_files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $attendanceManagement->external_files->pluck('file_name')->toArray();
        foreach ($request->input('external_files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $attendanceManagement->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('external_files');
            }
        }

        return (new AttendanceManagementResource($attendanceManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AttendanceManagement $attendanceManagement)
    {
        abort_if(Gate::denies('attendance_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendanceManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
