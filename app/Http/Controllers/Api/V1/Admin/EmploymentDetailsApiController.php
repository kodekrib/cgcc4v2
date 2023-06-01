<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmploymentDetailRequest;
use App\Http\Requests\UpdateEmploymentDetailRequest;
use App\Http\Resources\Admin\EmploymentDetailResource;
use App\Models\EmploymentDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmploymentDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employment_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmploymentDetailResource(EmploymentDetail::with(['industry', 'subsector', 'created_by'])->get());
    }

    public function store(StoreEmploymentDetailRequest $request)
    {
        $employmentDetail = EmploymentDetail::create($request->all());

        return (new EmploymentDetailResource($employmentDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmploymentDetail $employmentDetail)
    {
        abort_if(Gate::denies('employment_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmploymentDetailResource($employmentDetail->load(['industry', 'subsector', 'created_by']));
    }

    public function update(UpdateEmploymentDetailRequest $request, EmploymentDetail $employmentDetail)
    {
        $employmentDetail->update($request->all());

        return (new EmploymentDetailResource($employmentDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmploymentDetail $employmentDetail)
    {
        abort_if(Gate::denies('employment_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
