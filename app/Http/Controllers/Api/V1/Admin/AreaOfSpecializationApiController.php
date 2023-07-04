<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAreaOfSpecializationRequest;
use App\Http\Requests\UpdateAreaOfSpecializationRequest;
use App\Http\Resources\Admin\AreaOfSpecializationResource;
use App\Models\AreaOfSpecialization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AreaOfSpecializationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('area_of_specialization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AreaOfSpecializationResource(AreaOfSpecialization::all());
    }

    public function store(StoreAreaOfSpecializationRequest $request)
    {
        $areaOfSpecialization = AreaOfSpecialization::create($request->all());

        return (new AreaOfSpecializationResource($areaOfSpecialization))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AreaOfSpecialization $areaOfSpecialization)
    {
        abort_if(Gate::denies('area_of_specialization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AreaOfSpecializationResource($areaOfSpecialization);
    }

    public function update(UpdateAreaOfSpecializationRequest $request, AreaOfSpecialization $areaOfSpecialization)
    {
        $areaOfSpecialization->update($request->all());

        return (new AreaOfSpecializationResource($areaOfSpecialization))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AreaOfSpecialization $areaOfSpecialization)
    {
        abort_if(Gate::denies('area_of_specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areaOfSpecialization->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
