<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmploymentStatusRequest;
use App\Http\Requests\UpdateEmploymentStatusRequest;
use App\Http\Resources\Admin\EmploymentStatusResource;
use App\Models\EmploymentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmploymentStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employment_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmploymentStatusResource(EmploymentStatus::all());
    }

    public function store(StoreEmploymentStatusRequest $request)
    {
        $employmentStatus = EmploymentStatus::create($request->all());

        return (new EmploymentStatusResource($employmentStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmploymentStatus $employmentStatus)
    {
        abort_if(Gate::denies('employment_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmploymentStatusResource($employmentStatus);
    }

    public function update(UpdateEmploymentStatusRequest $request, EmploymentStatus $employmentStatus)
    {
        $employmentStatus->update($request->all());

        return (new EmploymentStatusResource($employmentStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmploymentStatus $employmentStatus)
    {
        abort_if(Gate::denies('employment_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
