<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Http\Resources\Admin\GoalResource;
use App\Models\Goal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GoalApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('goal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GoalResource(Goal::with(['created_by'])->get());
    }

    public function store(StoreGoalRequest $request)
    {
        $goal = Goal::create($request->all());

        return (new GoalResource($goal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Goal $goal)
    {
        abort_if(Gate::denies('goal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GoalResource($goal->load(['created_by']));
    }

    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $goal->update($request->all());

        return (new GoalResource($goal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Goal $goal)
    {
        abort_if(Gate::denies('goal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
