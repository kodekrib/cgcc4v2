<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAffinityGroupRequest;
use App\Http\Requests\UpdateAffinityGroupRequest;
use App\Http\Resources\Admin\AffinityGroupResource;
use App\Models\AffinityGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AffinityGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('affinity_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AffinityGroupResource(AffinityGroup::with(['head_of_group'])->get());
    }

    public function store(StoreAffinityGroupRequest $request)
    {
        $affinityGroup = AffinityGroup::create($request->all());

        return (new AffinityGroupResource($affinityGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AffinityGroup $affinityGroup)
    {
        abort_if(Gate::denies('affinity_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AffinityGroupResource($affinityGroup->load(['head_of_group']));
    }

    public function update(UpdateAffinityGroupRequest $request, AffinityGroup $affinityGroup)
    {
        $affinityGroup->update($request->all());

        return (new AffinityGroupResource($affinityGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
