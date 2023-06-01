<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMembersAffinityGroupRequest;
use App\Http\Requests\UpdateMembersAffinityGroupRequest;
use App\Http\Resources\Admin\MembersAffinityGroupResource;
use App\Models\MembersAffinityGroup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MembersAffinityGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('members_affinity_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MembersAffinityGroupResource(MembersAffinityGroup::with(['created_by'])->get());
    }

    public function store(StoreMembersAffinityGroupRequest $request)
    {
        $membersAffinityGroup = MembersAffinityGroup::create($request->all());

        return (new MembersAffinityGroupResource($membersAffinityGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MembersAffinityGroup $membersAffinityGroup)
    {
        abort_if(Gate::denies('members_affinity_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MembersAffinityGroupResource($membersAffinityGroup->load(['created_by']));
    }

    public function update(UpdateMembersAffinityGroupRequest $request, MembersAffinityGroup $membersAffinityGroup)
    {
        $membersAffinityGroup->update($request->all());

        return (new MembersAffinityGroupResource($membersAffinityGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MembersAffinityGroup $membersAffinityGroup)
    {
        abort_if(Gate::denies('members_affinity_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membersAffinityGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
