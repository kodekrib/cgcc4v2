<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAppointmentBookingRequest;
use App\Http\Requests\UpdateAppointmentBookingRequest;
use App\Http\Resources\Admin\AppointmentBookingResource;
use App\Models\AppointmentBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentBookingApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentBookingResource(AppointmentBooking::with(['appointment_type', 'assigned_to', 'created_by'])->get());
    }

    public function store(StoreAppointmentBookingRequest $request)
    {
        $appointmentBooking = AppointmentBooking::create($request->all());

        return (new AppointmentBookingResource($appointmentBooking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppointmentBooking $appointmentBooking)
    {
        abort_if(Gate::denies('appointment_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentBookingResource($appointmentBooking->load(['appointment_type', 'assigned_to', 'created_by']));
    }

    public function update(UpdateAppointmentBookingRequest $request, AppointmentBooking $appointmentBooking)
    {
        $appointmentBooking->update($request->all());

        return (new AppointmentBookingResource($appointmentBooking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppointmentBooking $appointmentBooking)
    {
        abort_if(Gate::denies('appointment_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentBooking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
