<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookingRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Venue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookings = Booking::with(['venue', 'event', 'status', 'created_by'])->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venues = Venue::pluck('venue_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookings.create', compact('events', 'venues'));
    }

    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create($request->all());

        return redirect()->route('admin.bookings.index');
    }

    public function edit(Booking $booking)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venues = Venue::pluck('venue_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Venue::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking->load('venue', 'event', 'status', 'created_by');

        return view('admin.bookings.edit', compact('booking', 'events', 'statuses', 'venues'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->all());

        return redirect()->route('admin.bookings.index');
    }

    public function show(Booking $booking)
    {
        abort_if(Gate::denies('booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->load('venue', 'event', 'status', 'created_by');

        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingRequest $request)
    {
        Booking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
