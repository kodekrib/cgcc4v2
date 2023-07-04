<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCihTypesOfRequestRequest;
use App\Http\Requests\UpdateCihTypesOfRequestRequest;
use App\Http\Resources\Admin\CihTypesOfRequestResource;
use App\Models\CihTypesOfRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihTypesOfRequestApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cih_types_of_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihTypesOfRequestResource(CihTypesOfRequest::all());
    }

    public function store(StoreCihTypesOfRequestRequest $request)
    {
        $cihTypesOfRequest = CihTypesOfRequest::create($request->all());

        return (new CihTypesOfRequestResource($cihTypesOfRequest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CihTypesOfRequest $cihTypesOfRequest)
    {
        abort_if(Gate::denies('cih_types_of_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihTypesOfRequestResource($cihTypesOfRequest);
    }

    public function update(UpdateCihTypesOfRequestRequest $request, CihTypesOfRequest $cihTypesOfRequest)
    {
        $cihTypesOfRequest->update($request->all());

        return (new CihTypesOfRequestResource($cihTypesOfRequest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CihTypesOfRequest $cihTypesOfRequest)
    {
        abort_if(Gate::denies('cih_types_of_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihTypesOfRequest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
