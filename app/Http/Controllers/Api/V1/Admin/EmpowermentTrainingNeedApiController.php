<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpowermentTrainingNeedRequest;
use App\Http\Requests\UpdateEmpowermentTrainingNeedRequest;
use App\Http\Resources\Admin\EmpowermentTrainingNeedResource;
use App\Models\EmpowermentTrainingNeed;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpowermentTrainingNeedApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('empowerment_training_need_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmpowermentTrainingNeedResource(EmpowermentTrainingNeed::all());
    }

    public function store(StoreEmpowermentTrainingNeedRequest $request)
    {
        $empowermentTrainingNeed = EmpowermentTrainingNeed::create($request->all());

        return (new EmpowermentTrainingNeedResource($empowermentTrainingNeed))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        abort_if(Gate::denies('empowerment_training_need_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmpowermentTrainingNeedResource($empowermentTrainingNeed);
    }

    public function update(UpdateEmpowermentTrainingNeedRequest $request, EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        $empowermentTrainingNeed->update($request->all());

        return (new EmpowermentTrainingNeedResource($empowermentTrainingNeed))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmpowermentTrainingNeed $empowermentTrainingNeed)
    {
        abort_if(Gate::denies('empowerment_training_need_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empowermentTrainingNeed->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
