<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMountainOfInfluenceRequest;
use App\Http\Requests\UpdateMountainOfInfluenceRequest;
use App\Http\Resources\Admin\MountainOfInfluenceResource;
use App\Models\MountainOfInfluence;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MountainOfInfluenceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mountain_of_influence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MountainOfInfluenceResource(MountainOfInfluence::with(['my_mountain_of_culture', 'created_by'])->get());
    }

    public function store(StoreMountainOfInfluenceRequest $request)
    {
        $mountainOfInfluence = MountainOfInfluence::create($request->all());

        return (new MountainOfInfluenceResource($mountainOfInfluence))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MountainOfInfluence $mountainOfInfluence)
    {
        abort_if(Gate::denies('mountain_of_influence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MountainOfInfluenceResource($mountainOfInfluence->load(['my_mountain_of_culture', 'created_by']));
    }

    public function update(UpdateMountainOfInfluenceRequest $request, MountainOfInfluence $mountainOfInfluence)
    {
        $mountainOfInfluence->update($request->all());

        return (new MountainOfInfluenceResource($mountainOfInfluence))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MountainOfInfluence $mountainOfInfluence)
    {
        abort_if(Gate::denies('mountain_of_influence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainOfInfluence->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
