<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInspectorateGroupRequest;
use App\Http\Requests\StoreInspectorateGroupRequest;
use App\Http\Requests\UpdateInspectorateGroupRequest;
use App\Models\InspectorateGroup;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectorateGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inspectorate_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectorateGroups = InspectorateGroup::with(['group', 'created_by'])->get();

        return view('admin.inspectorateGroups.index', compact('inspectorateGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('inspectorate_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.inspectorateGroups.create', compact('groups'));
    }

    public function store(StoreInspectorateGroupRequest $request)
    {
        $inspectorateGroup = InspectorateGroup::create($request->all());

        return redirect()->route('admin.inspectorate-groups.index');
    }

    public function edit(InspectorateGroup $inspectorateGroup)
    {
        abort_if(Gate::denies('inspectorate_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $inspectorateGroup->load('group', 'created_by');

        return view('admin.inspectorateGroups.edit', compact('groups', 'inspectorateGroup'));
    }

    public function update(UpdateInspectorateGroupRequest $request, InspectorateGroup $inspectorateGroup)
    {
        $inspectorateGroup->update($request->all());

        return redirect()->route('admin.inspectorate-groups.index');
    }

    public function show(InspectorateGroup $inspectorateGroup)
    {
        abort_if(Gate::denies('inspectorate_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectorateGroup->load('group', 'created_by');

        return view('admin.inspectorateGroups.show', compact('inspectorateGroup'));
    }

    public function destroy(InspectorateGroup $inspectorateGroup)
    {
        abort_if(Gate::denies('inspectorate_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectorateGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyInspectorateGroupRequest $request)
    {
        $inspectorateGroups = InspectorateGroup::find(request('ids'));

        foreach ($inspectorateGroups as $inspectorateGroup) {
            $inspectorateGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
