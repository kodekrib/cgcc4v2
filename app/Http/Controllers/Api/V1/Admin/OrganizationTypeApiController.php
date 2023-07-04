<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationTypeRequest;
use App\Http\Requests\UpdateOrganizationTypeRequest;
use App\Http\Resources\Admin\OrganizationTypeResource;
use App\Models\OrganizationType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('organization_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrganizationTypeResource(OrganizationType::all());
    }

    public function store(StoreOrganizationTypeRequest $request)
    {
        $organizationType = OrganizationType::create($request->all());

        return (new OrganizationTypeResource($organizationType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OrganizationType $organizationType)
    {
        abort_if(Gate::denies('organization_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrganizationTypeResource($organizationType);
    }

    public function update(UpdateOrganizationTypeRequest $request, OrganizationType $organizationType)
    {
        $organizationType->update($request->all());

        return (new OrganizationTypeResource($organizationType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OrganizationType $organizationType)
    {
        abort_if(Gate::denies('organization_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizationType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
