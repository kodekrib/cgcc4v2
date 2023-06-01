<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMountainsOfInfluenceRequest;
use App\Http\Requests\StoreMountainsOfInfluenceRequest;
use App\Http\Requests\UpdateMountainsOfInfluenceRequest;
use App\Models\MountainsOfInfluence;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MountainsOfInfluenceController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('mountains_of_influence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainsOfInfluences = MountainsOfInfluence::with(['mountain_leader'])->get();

        return view('admin.mountainsOfInfluences.index', compact('mountainsOfInfluences'));
    }

    public function create()
    {
        abort_if(Gate::denies('mountains_of_influence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountain_leaders = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mountainsOfInfluences.create', compact('mountain_leaders'));
    }

    public function store(StoreMountainsOfInfluenceRequest $request)
    {
        $mountainsOfInfluence = MountainsOfInfluence::create($request->all());

        return redirect()->route('admin.mountains-of-influences.index');
    }

    public function edit(MountainsOfInfluence $mountainsOfInfluence)
    {
        abort_if(Gate::denies('mountains_of_influence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountain_leaders = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mountainsOfInfluence->load('mountain_leader');

        return view('admin.mountainsOfInfluences.edit', compact('mountain_leaders', 'mountainsOfInfluence'));
    }

    public function update(UpdateMountainsOfInfluenceRequest $request, MountainsOfInfluence $mountainsOfInfluence)
    {
        $mountainsOfInfluence->update($request->all());

        return redirect()->route('admin.mountains-of-influences.index');
    }

    public function show(MountainsOfInfluence $mountainsOfInfluence)
    {
        abort_if(Gate::denies('mountains_of_influence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainsOfInfluence->load('mountain_leader');

        return view('admin.mountainsOfInfluences.show', compact('mountainsOfInfluence'));
    }

    public function destroy(MountainsOfInfluence $mountainsOfInfluence)
    {
        abort_if(Gate::denies('mountains_of_influence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainsOfInfluence->delete();

        return back();
    }

    public function massDestroy(MassDestroyMountainsOfInfluenceRequest $request)
    {
        MountainsOfInfluence::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
