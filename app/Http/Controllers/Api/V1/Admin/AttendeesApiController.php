<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendeeRequest;
use App\Http\Requests\UpdateAttendeeRequest;
use App\Http\Resources\Admin\AttendeeResource;
use App\Models\Attendee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendeesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendeeResource(Attendee::all());
    }

    public function store(StoreAttendeeRequest $request)
    {
        $attendee = Attendee::create($request->all());

        return (new AttendeeResource($attendee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Attendee $attendee)
    {
        abort_if(Gate::denies('attendee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttendeeResource($attendee);
    }

    public function update(UpdateAttendeeRequest $request, Attendee $attendee)
    {
        $attendee->update($request->all());

        return (new AttendeeResource($attendee))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Attendee $attendee)
    {
        abort_if(Gate::denies('attendee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
