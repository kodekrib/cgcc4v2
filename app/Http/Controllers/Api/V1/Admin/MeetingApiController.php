<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Http\Resources\Admin\MeetingResource;
use App\Models\Meeting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeetingApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MeetingResource(Meeting::with(['meeting_type', 'venue', 'attendees', 'created_by'])->get());
    }

    public function store(StoreMeetingRequest $request)
    {
        $meeting = Meeting::create($request->all());

        foreach ($request->input('meeting_minutes', []) as $file) {
            $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('meeting_minutes');
        }

        foreach ($request->input('files', []) as $file) {
            $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        return (new MeetingResource($meeting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MeetingResource($meeting->load(['meeting_type', 'venue', 'attendees', 'created_by']));
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $meeting->update($request->all());

        if (count($meeting->meeting_minutes) > 0) {
            foreach ($meeting->meeting_minutes as $media) {
                if (!in_array($media->file_name, $request->input('meeting_minutes', []))) {
                    $media->delete();
                }
            }
        }
        $media = $meeting->meeting_minutes->pluck('file_name')->toArray();
        foreach ($request->input('meeting_minutes', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('meeting_minutes');
            }
        }

        if (count($meeting->files) > 0) {
            foreach ($meeting->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $meeting->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $meeting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return (new MeetingResource($meeting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
