<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVenueAccessoryRequest;
use App\Http\Requests\UpdateVenueAccessoryRequest;
use App\Http\Resources\Admin\VenueAccessoryResource;
use App\Models\VenueAccessory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenueAccessoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('venue_accessory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueAccessoryResource(VenueAccessory::all());
    }

    public function store(StoreVenueAccessoryRequest $request)
    {
        $venueAccessory = VenueAccessory::create($request->all());

        return (new VenueAccessoryResource($venueAccessory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VenueAccessory $venueAccessory)
    {
        abort_if(Gate::denies('venue_accessory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VenueAccessoryResource($venueAccessory);
    }

    public function update(UpdateVenueAccessoryRequest $request, VenueAccessory $venueAccessory)
    {
        $venueAccessory->update($request->all());

        return (new VenueAccessoryResource($venueAccessory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VenueAccessory $venueAccessory)
    {
        abort_if(Gate::denies('venue_accessory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venueAccessory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
