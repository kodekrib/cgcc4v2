<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\StoreAffinityGroupRequest;
use App\Http\Requests\UpdateAffinityGroupRequest;
use App\Models\AffinityGroup;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AffinityGroupController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('affinity_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $affinityGroups = AffinityGroup::with(['head_of_group'])->get();

        return view('admin.affinityGroups.index', compact('affinityGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('affinity_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $head_of_groups = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.affinityGroups.create', compact('head_of_groups'));
    }

    public function store(StoreAffinityGroupRequest $request)
    {
        $affinityGroup = AffinityGroup::create($request->all());

        return redirect()->route('admin.affinity-groups.index');
    }

    public function edit(AffinityGroup $affinityGroup)
    {
        abort_if(Gate::denies('affinity_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $head_of_groups = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $affinityGroup->load('head_of_group');

        return view('admin.affinityGroups.edit', compact('affinityGroup', 'head_of_groups'));
    }

    public function update(UpdateAffinityGroupRequest $request, AffinityGroup $affinityGroup)
    {
        $affinityGroup->update($request->all());

        return redirect()->route('admin.affinity-groups.index');
    }

    public function show(AffinityGroup $affinityGroup)
    {
        abort_if(Gate::denies('affinity_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $affinityGroup->load('head_of_group');

        return view('admin.affinityGroups.show', compact('affinityGroup'));
    }
}
