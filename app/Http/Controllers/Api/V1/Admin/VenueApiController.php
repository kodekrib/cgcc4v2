<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Http\Resources\Admin\VenueResource;
use App\Models\Venue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueResource(Venue::with(['accessories_equipments', 'accessibility_features', 'venue_location', 'created_by'])->get());
    }

    public function store(StoreVenueRequest $request)
    {
        $venue = Venue::create($request->all());
        $venue->accessories_equipments()->sync($request->input('accessories_equipments', []));
        $venue->accessibility_features()->sync($request->input('accessibility_features', []));

        return (new VenueResource($venue))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Venue $venue)
    {
        abort_if(Gate::denies('venue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueResource($venue->load(['accessories_equipments', 'accessibility_features', 'venue_location', 'created_by']));
    }

    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue->update($request->all());
        $venue->accessories_equipments()->sync($request->input('accessories_equipments', []));
        $venue->accessibility_features()->sync($request->input('accessibility_features', []));

        return (new VenueResource($venue))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Venue $venue)
    {
        abort_if(Gate::denies('venue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venue->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
