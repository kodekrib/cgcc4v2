<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAncillaryManagementRequest;
use App\Http\Requests\UpdateAncillaryManagementRequest;
use App\Http\Resources\Admin\AncillaryManagementResource;
use App\Models\AncillaryManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AncillaryManagementApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ancillary_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AncillaryManagementResource(AncillaryManagement::with(['service_type', 'created_by'])->get());
    }

    public function store(StoreAncillaryManagementRequest $request)
    {
        $ancillaryManagement = AncillaryManagement::create($request->all());

        return (new AncillaryManagementResource($ancillaryManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AncillaryManagement $ancillaryManagement)
    {
        abort_if(Gate::denies('ancillary_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AncillaryManagementResource($ancillaryManagement->load(['service_type', 'created_by']));
    }

    public function update(UpdateAncillaryManagementRequest $request, AncillaryManagement $ancillaryManagement)
    {
        $ancillaryManagement->update($request->all());

        return (new AncillaryManagementResource($ancillaryManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AncillaryManagement $ancillaryManagement)
    {
        abort_if(Gate::denies('ancillary_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ancillaryManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
