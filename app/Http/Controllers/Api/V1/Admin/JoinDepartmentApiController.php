<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJoinDepartmentRequest;
use App\Http\Requests\UpdateJoinDepartmentRequest;
use App\Http\Resources\Admin\JoinDepartmentResource;
use App\Models\JoinDepartment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JoinDepartmentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('join_department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JoinDepartmentResource(JoinDepartment::with(['department', 'created_by'])->get());
    }

    public function store(StoreJoinDepartmentRequest $request)
    {
        $joinDepartment = JoinDepartment::create($request->all());

        return (new JoinDepartmentResource($joinDepartment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JoinDepartment $joinDepartment)
    {
        abort_if(Gate::denies('join_department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JoinDepartmentResource($joinDepartment->load(['department', 'created_by']));
    }

    public function update(UpdateJoinDepartmentRequest $request, JoinDepartment $joinDepartment)
    {
        $joinDepartment->update($request->all());

        return (new JoinDepartmentResource($joinDepartment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JoinDepartment $joinDepartment)
    {
        abort_if(Gate::denies('join_department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $joinDepartment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
