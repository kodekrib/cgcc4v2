<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFirstTimerRequest;
use App\Http\Requests\UpdateFirstTimerRequest;
use App\Http\Resources\Admin\FirstTimerResource;
use App\Models\FirstTimer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FirstTimerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('first_timer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FirstTimerResource(FirstTimer::with(['marital_status'])->get());
    }

    public function store(StoreFirstTimerRequest $request)
    {
        $firstTimer = FirstTimer::create($request->all());

        return (new FirstTimerResource($firstTimer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FirstTimer $firstTimer)
    {
        abort_if(Gate::denies('first_timer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FirstTimerResource($firstTimer->load(['marital_status']));
    }

    public function update(UpdateFirstTimerRequest $request, FirstTimer $firstTimer)
    {
        $firstTimer->update($request->all());

        return (new FirstTimerResource($firstTimer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FirstTimer $firstTimer)
    {
        abort_if(Gate::denies('first_timer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $firstTimer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
