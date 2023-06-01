<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubSectorRequest;
use App\Http\Requests\UpdateSubSectorRequest;
use App\Http\Resources\Admin\SubSectorResource;
use App\Models\SubSector;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubSectorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sub_sector_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubSectorResource(SubSector::with(['industry'])->get());
    }

    public function store(StoreSubSectorRequest $request)
    {
        $subSector = SubSector::create($request->all());

        return (new SubSectorResource($subSector))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubSector $subSector)
    {
        abort_if(Gate::denies('sub_sector_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubSectorResource($subSector->load(['industry']));
    }

    public function update(UpdateSubSectorRequest $request, SubSector $subSector)
    {
        $subSector->update($request->all());

        return (new SubSectorResource($subSector))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubSector $subSector)
    {
        abort_if(Gate::denies('sub_sector_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subSector->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
