<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionaryForceRequest;
use App\Http\Requests\UpdateMissionaryForceRequest;
use App\Models\MissionaryForce;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MissionaryForceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('missionary_force_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $missionaryForces = MissionaryForce::with(['created_by'])->get();

        return view('admin.missionaryForces.index', compact('missionaryForces'));
    }

    public function create()
    {
        abort_if(Gate::denies('missionary_force_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.missionaryForces.create');
    }

    public function store(StoreMissionaryForceRequest $request)
    {
        $missionaryForce = MissionaryForce::create($request->all());

        return redirect()->route('admin.missionary-forces.index');
    }

    public function edit(MissionaryForce $missionaryForce)
    {
        abort_if(Gate::denies('missionary_force_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $missionaryForce->load('created_by');

        return view('admin.missionaryForces.edit', compact('missionaryForce'));
    }

    public function update(UpdateMissionaryForceRequest $request, MissionaryForce $missionaryForce)
    {
        $missionaryForce->update($request->all());

        return redirect()->route('admin.missionary-forces.index');
    }

    public function show(MissionaryForce $missionaryForce)
    {
        abort_if(Gate::denies('missionary_force_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $missionaryForce->load('created_by');

        return view('admin.missionaryForces.show', compact('missionaryForce'));
    }
}
