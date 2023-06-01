<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCihmemberRequest;
use App\Http\Requests\UpdateCihmemberRequest;
use App\Http\Resources\Admin\CihmemberResource;
use App\Models\Cihmember;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihmemberApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cihmember_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihmemberResource(Cihmember::with(['zone', 'cih', 'created_by'])->get());
    }

    public function store(StoreCihmemberRequest $request)
    {
        $cihmember = Cihmember::create($request->all());

        return (new CihmemberResource($cihmember))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cihmember $cihmember)
    {
        abort_if(Gate::denies('cihmember_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CihmemberResource($cihmember->load(['zone', 'cih', 'created_by']));
    }

    public function update(UpdateCihmemberRequest $request, Cihmember $cihmember)
    {
        $cihmember->update($request->all());

        return (new CihmemberResource($cihmember))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cihmember $cihmember)
    {
        abort_if(Gate::denies('cihmember_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihmember->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
