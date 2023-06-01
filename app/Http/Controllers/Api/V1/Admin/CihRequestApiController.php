<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCihRequestRequest;
use App\Http\Requests\UpdateCihRequestRequest;
use App\Http\Resources\Admin\CihRequestResource;
use App\Models\CihRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihRequestApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cih_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihRequestResource(CihRequest::with(['requester_name', 'types_of_request'])->get());
    }

    public function store(StoreCihRequestRequest $request)
    {
        $cihRequest = CihRequest::create($request->all());

        return (new CihRequestResource($cihRequest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CihRequest $cihRequest)
    {
        abort_if(Gate::denies('cih_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihRequestResource($cihRequest->load(['requester_name', 'types_of_request']));
    }

    public function update(UpdateCihRequestRequest $request, CihRequest $cihRequest)
    {
        $cihRequest->update($request->all());

        return (new CihRequestResource($cihRequest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CihRequest $cihRequest)
    {
        abort_if(Gate::denies('cih_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihRequest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
