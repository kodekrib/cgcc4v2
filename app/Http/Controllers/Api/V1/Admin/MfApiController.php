<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMfRequest;
use App\Http\Requests\UpdateMfRequest;
use App\Http\Resources\Admin\MfResource;
use App\Models\Mf;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MfApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mf_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MfResource(Mf::with(['created_by'])->get());
    }

    public function store(StoreMfRequest $request)
    {
        $mf = Mf::create($request->all());

        return (new MfResource($mf))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Mf $mf)
    {
        abort_if(Gate::denies('mf_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MfResource($mf->load(['created_by']));
    }

    public function update(UpdateMfRequest $request, Mf $mf)
    {
        $mf->update($request->all());

        return (new MfResource($mf))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Mf $mf)
    {
        abort_if(Gate::denies('mf_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mf->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
