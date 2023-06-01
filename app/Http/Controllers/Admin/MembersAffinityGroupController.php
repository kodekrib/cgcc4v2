<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMembersAffinityGroupRequest;
use App\Http\Requests\StoreMembersAffinityGroupRequest;
use App\Http\Requests\UpdateMembersAffinityGroupRequest;
use App\Models\MembersAffinityGroup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MembersAffinityGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('members_affinity_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membersAffinityGroups = MembersAffinityGroup::with(['created_by'])->get();

        return view('admin.membersAffinityGroups.index', compact('membersAffinityGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('members_affinity_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.membersAffinityGroups.create');
    }

    public function store(StoreMembersAffinityGroupRequest $request)
    {
        $membersAffinityGroup = MembersAffinityGroup::create($request->all());

        return redirect()->route('admin.members-affinity-groups.index');
    }

    public function edit(MembersAffinityGroup $membersAffinityGroup)
    {
        abort_if(Gate::denies('members_affinity_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membersAffinityGroup->load('created_by');

        return view('admin.membersAffinityGroups.edit', compact('membersAffinityGroup'));
    }

    public function update(UpdateMembersAffinityGroupRequest $request, MembersAffinityGroup $membersAffinityGroup)
    {
        $membersAffinityGroup->update($request->all());

        return redirect()->route('admin.members-affinity-groups.index');
    }

    public function show(MembersAffinityGroup $membersAffinityGroup)
    {
        abort_if(Gate::denies('members_affinity_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membersAffinityGroup->load('created_by');

        return view('admin.membersAffinityGroups.show', compact('membersAffinityGroup'));
    }

    public function destroy(MembersAffinityGroup $membersAffinityGroup)
    {
        abort_if(Gate::denies('members_affinity_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $membersAffinityGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyMembersAffinityGroupRequest $request)
    {
        $membersAffinityGroups = MembersAffinityGroup::find(request('ids'));

        foreach ($membersAffinityGroups as $membersAffinityGroup) {
            $membersAffinityGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
