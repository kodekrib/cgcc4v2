<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMountainsOfInfluenceRequest;
use App\Http\Requests\UpdateMountainsOfInfluenceRequest;
use App\Http\Resources\Admin\MountainsOfInfluenceResource;
use App\Models\MountainsOfInfluence;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MountainsOfInfluenceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mountains_of_influence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MountainsOfInfluenceResource(MountainsOfInfluence::with(['mountain_leader'])->get());
    }

    public function store(StoreMountainsOfInfluenceRequest $request)
    {
        $mountainsOfInfluence = MountainsOfInfluence::create($request->all());

        return (new MountainsOfInfluenceResource($mountainsOfInfluence))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MountainsOfInfluence $mountainsOfInfluence)
    {
        abort_if(Gate::denies('mountains_of_influence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MountainsOfInfluenceResource($mountainsOfInfluence->load(['mountain_leader']));
    }

    public function update(UpdateMountainsOfInfluenceRequest $request, MountainsOfInfluence $mountainsOfInfluence)
    {
        $mountainsOfInfluence->update($request->all());

        return (new MountainsOfInfluenceResource($mountainsOfInfluence))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MountainsOfInfluence $mountainsOfInfluence)
    {
        abort_if(Gate::denies('mountains_of_influence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainsOfInfluence->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
