<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutreachTypeRequest;
use App\Http\Requests\UpdateOutreachTypeRequest;
use App\Http\Resources\Admin\OutreachTypeResource;
use App\Models\OutreachType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutreachTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('outreach_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutreachTypeResource(OutreachType::all());
    }

    public function store(StoreOutreachTypeRequest $request)
    {
        $outreachType = OutreachType::create($request->all());

        return (new OutreachTypeResource($outreachType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OutreachType $outreachType)
    {
        abort_if(Gate::denies('outreach_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutreachTypeResource($outreachType);
    }

    public function update(UpdateOutreachTypeRequest $request, OutreachType $outreachType)
    {
        $outreachType->update($request->all());

        return (new OutreachTypeResource($outreachType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OutreachType $outreachType)
    {
        abort_if(Gate::denies('outreach_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outreachType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
