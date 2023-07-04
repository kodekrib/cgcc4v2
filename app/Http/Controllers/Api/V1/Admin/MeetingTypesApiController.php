<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeetingTypeRequest;
use App\Http\Requests\UpdateMeetingTypeRequest;
use App\Http\Resources\Admin\MeetingTypeResource;
use App\Models\MeetingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeetingTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('meeting_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MeetingTypeResource(MeetingType::all());
    }

    public function store(StoreMeetingTypeRequest $request)
    {
        $meetingType = MeetingType::create($request->all());

        return (new MeetingTypeResource($meetingType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MeetingType $meetingType)
    {
        abort_if(Gate::denies('meeting_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MeetingTypeResource($meetingType);
    }

    public function update(UpdateMeetingTypeRequest $request, MeetingType $meetingType)
    {
        $meetingType->update($request->all());

        return (new MeetingTypeResource($meetingType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MeetingType $meetingType)
    {
        abort_if(Gate::denies('meeting_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meetingType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
