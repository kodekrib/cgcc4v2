<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpowermentRequest;
use App\Http\Requests\UpdateEmpowermentRequest;
use App\Http\Resources\Admin\EmpowermentResource;
use App\Models\Empowerment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpowermentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('empowerment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmpowermentResource(Empowerment::with(['ats_membership_no', 'training_needs'])->get());
    }

    public function store(StoreEmpowermentRequest $request)
    {
        $empowerment = Empowerment::create($request->all());
        $empowerment->training_needs()->sync($request->input('training_needs', []));

        return (new EmpowermentResource($empowerment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Empowerment $empowerment)
    {
        abort_if(Gate::denies('empowerment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmpowermentResource($empowerment->load(['ats_membership_no', 'training_needs']));
    }

    public function update(UpdateEmpowermentRequest $request, Empowerment $empowerment)
    {
        $empowerment->update($request->all());
        $empowerment->training_needs()->sync($request->input('training_needs', []));

        return (new EmpowermentResource($empowerment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
