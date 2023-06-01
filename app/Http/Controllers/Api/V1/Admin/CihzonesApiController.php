<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCihzoneRequest;
use App\Http\Requests\UpdateCihzoneRequest;
use App\Http\Resources\Admin\CihzoneResource;
use App\Models\Cihzone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihzonesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cihzone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihzoneResource(Cihzone::with(['coordinator', 'created_by'])->get());
    }

    public function store(StoreCihzoneRequest $request)
    {
        $cihzone = Cihzone::create($request->all());

        return (new CihzoneResource($cihzone))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cihzone $cihzone)
    {
        abort_if(Gate::denies('cihzone_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihzoneResource($cihzone->load(['coordinator', 'created_by']));
    }

    public function update(UpdateCihzoneRequest $request, Cihzone $cihzone)
    {
        $cihzone->update($request->all());

        return (new CihzoneResource($cihzone))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cihzone $cihzone)
    {
        abort_if(Gate::denies('cihzone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihzone->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
