<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMountainOfInfluenceRequest;
use App\Http\Requests\StoreMountainOfInfluenceRequest;
use App\Http\Requests\UpdateMountainOfInfluenceRequest;
use App\Models\MountainOfInfluence;
use App\Models\MountainsOfInfluence;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MountainOfInfluenceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mountain_of_influence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainOfInfluences = MountainOfInfluence::with(['my_mountain_of_culture', 'created_by'])->get();

        return view('admin.mountainOfInfluences.index', compact('mountainOfInfluences'));
    }

    public function create()
    {
        abort_if(Gate::denies('mountain_of_influence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $my_mountain_of_cultures = MountainsOfInfluence::pluck('corresponding_mountain', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mountainOfInfluences.create', compact('my_mountain_of_cultures'));
    }

    public function store(StoreMountainOfInfluenceRequest $request)
    {
        $mountainOfInfluence = MountainOfInfluence::create($request->all());

        return redirect()->route('admin.mountain-of-influences.index');
    }

    public function edit(MountainOfInfluence $mountainOfInfluence)
    {
        abort_if(Gate::denies('mountain_of_influence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $my_mountain_of_cultures = MountainsOfInfluence::pluck('corresponding_mountain', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mountainOfInfluence->load('my_mountain_of_culture', 'created_by');

        return view('admin.mountainOfInfluences.edit', compact('mountainOfInfluence', 'my_mountain_of_cultures'));
    }

    public function update(UpdateMountainOfInfluenceRequest $request, MountainOfInfluence $mountainOfInfluence)
    {
        $mountainOfInfluence->update($request->all());

        return redirect()->route('admin.mountain-of-influences.index');
    }

    public function show(MountainOfInfluence $mountainOfInfluence)
    {
        abort_if(Gate::denies('mountain_of_influence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainOfInfluence->load('my_mountain_of_culture', 'created_by');

        return view('admin.mountainOfInfluences.show', compact('mountainOfInfluence'));
    }

    public function destroy(MountainOfInfluence $mountainOfInfluence)
    {
        abort_if(Gate::denies('mountain_of_influence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mountainOfInfluence->delete();

        return back();
    }

    public function massDestroy(MassDestroyMountainOfInfluenceRequest $request)
    {
        MountainOfInfluence::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
