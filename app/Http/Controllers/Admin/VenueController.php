<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVenueRequest;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\AccessibilityFeature;
use App\Models\Location;
use App\Models\Venue;
use App\Models\VenueAccessory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venues = Venue::with(['accessories_equipments', 'accessibility_features', 'venue_location', 'created_by'])->get();

        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessories_equipments = VenueAccessory::pluck('accessories', 'id');

        $accessibility_features = AccessibilityFeature::pluck('name', 'id');

        $venue_locations = Location::pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.venues.create', compact('accessibility_features', 'accessories_equipments', 'venue_locations'));
    }

    public function store(StoreVenueRequest $request)
    {
        $venue = Venue::create($request->all());
        $venue->accessories_equipments()->sync($request->input('accessories_equipments', []));
        $venue->accessibility_features()->sync($request->input('accessibility_features', []));

        return redirect()->route('admin.venues.index');
    }

    public function edit(Venue $venue)
    {
        abort_if(Gate::denies('venue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accessories_equipments = VenueAccessory::pluck('accessories', 'id');

        $accessibility_features = AccessibilityFeature::pluck('name', 'id');

        $venue_locations = Location::pluck('location', 'id')->prepend(trans('global.pleaseSelect'), '');

        $venue->load('accessories_equipments', 'accessibility_features', 'venue_location', 'created_by');

        return view('admin.venues.edit', compact('accessibility_features', 'accessories_equipments', 'venue', 'venue_locations'));
    }

    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue->update($request->all());
        $venue->accessories_equipments()->sync($request->input('accessories_equipments', []));
        $venue->accessibility_features()->sync($request->input('accessibility_features', []));

        return redirect()->route('admin.venues.index');
    }

    public function show(Venue $venue)
    {
        abort_if(Gate::denies('venue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venue->load('accessories_equipments', 'accessibility_features', 'venue_location', 'created_by', 'venueBookings');

        return view('admin.venues.show', compact('venue'));
    }

    public function destroy(Venue $venue)
    {
        abort_if(Gate::denies('venue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venue->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueRequest $request)
    {
        Venue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
