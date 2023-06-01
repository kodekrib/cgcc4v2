<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCihCentersInspectionRequest;
use App\Http\Requests\UpdateCihCentersInspectionRequest;
use App\Http\Resources\Admin\CihCentersInspectionResource;
use App\Models\CihCentersInspection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihCentersInspectionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cih_centers_inspection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihCentersInspectionResource(CihCentersInspection::with(['center_visited'])->get());
    }

    public function store(StoreCihCentersInspectionRequest $request)
    {
        $cihCentersInspection = CihCentersInspection::create($request->all());

        return (new CihCentersInspectionResource($cihCentersInspection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CihCentersInspection $cihCentersInspection)
    {
        abort_if(Gate::denies('cih_centers_inspection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihCentersInspectionResource($cihCentersInspection->load(['center_visited']));
    }

    public function update(UpdateCihCentersInspectionRequest $request, CihCentersInspection $cihCentersInspection)
    {
        $cihCentersInspection->update($request->all());

        return (new CihCentersInspectionResource($cihCentersInspection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CihCentersInspection $cihCentersInspection)
    {
        abort_if(Gate::denies('cih_centers_inspection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihCentersInspection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
