<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttendeeRequest;
use App\Http\Requests\StoreAttendeeRequest;
use App\Http\Requests\UpdateAttendeeRequest;
use App\Models\Attendee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendeesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendees = Attendee::all();

        return view('admin.attendees.index', compact('attendees'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendees.create');
    }

    public function store(StoreAttendeeRequest $request)
    {
        $attendee = Attendee::create($request->all());

        return redirect()->route('admin.attendees.index');
    }

    public function edit(Attendee $attendee)
    {
        abort_if(Gate::denies('attendee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendees.edit', compact('attendee'));
    }

    public function update(UpdateAttendeeRequest $request, Attendee $attendee)
    {
        $attendee->update($request->all());

        return redirect()->route('admin.attendees.index');
    }

    public function show(Attendee $attendee)
    {
        abort_if(Gate::denies('attendee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attendees.show', compact('attendee'));
    }

    public function destroy(Attendee $attendee)
    {
        abort_if(Gate::denies('attendee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendee->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendeeRequest $request)
    {
        Attendee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
