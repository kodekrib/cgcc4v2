<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionaryForceRequest;
use App\Http\Requests\UpdateMissionaryForceRequest;
use App\Http\Resources\Admin\MissionaryForceResource;
use App\Models\MissionaryForce;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MissionaryForceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('missionary_force_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MissionaryForceResource(MissionaryForce::with(['created_by'])->get());
    }

    public function store(StoreMissionaryForceRequest $request)
    {
        $missionaryForce = MissionaryForce::create($request->all());

        return (new MissionaryForceResource($missionaryForce))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MissionaryForce $missionaryForce)
    {
        abort_if(Gate::denies('missionary_force_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MissionaryForceResource($missionaryForce->load(['created_by']));
    }

    public function update(UpdateMissionaryForceRequest $request, MissionaryForce $missionaryForce)
    {
        $missionaryForce->update($request->all());

        return (new MissionaryForceResource($missionaryForce))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
