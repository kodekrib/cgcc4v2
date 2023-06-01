<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInspectorateGroupRequest;
use App\Http\Requests\UpdateInspectorateGroupRequest;
use App\Http\Resources\Admin\InspectorateGroupResource;
use App\Models\InspectorateGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectorateGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('inspectorate_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InspectorateGroupResource(InspectorateGroup::with(['group', 'created_by'])->get());
    }

    public function store(StoreInspectorateGroupRequest $request)
    {
        $inspectorateGroup = InspectorateGroup::create($request->all());

        return (new InspectorateGroupResource($inspectorateGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InspectorateGroup $inspectorateGroup)
    {
        abort_if(Gate::denies('inspectorate_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InspectorateGroupResource($inspectorateGroup->load(['group', 'created_by']));
    }

    public function update(UpdateInspectorateGroupRequest $request, InspectorateGroup $inspectorateGroup)
    {
        $inspectorateGroup->update($request->all());

        return (new InspectorateGroupResource($inspectorateGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InspectorateGroup $inspectorateGroup)
    {
        abort_if(Gate::denies('inspectorate_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inspectorateGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
