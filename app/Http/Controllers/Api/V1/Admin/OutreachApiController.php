<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutreachRequest;
use App\Http\Requests\UpdateOutreachRequest;
use App\Http\Resources\Admin\OutreachResource;
use App\Models\Outreach;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutreachApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('outreach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutreachResource(Outreach::with(['type', 'location', 'contact_person'])->get());
    }

    public function store(StoreOutreachRequest $request)
    {
        $outreach = Outreach::create($request->all());

        return (new OutreachResource($outreach))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Outreach $outreach)
    {
        abort_if(Gate::denies('outreach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutreachResource($outreach->load(['type', 'location', 'contact_person']));
    }

    public function update(UpdateOutreachRequest $request, Outreach $outreach)
    {
        $outreach->update($request->all());

        return (new OutreachResource($outreach))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Outreach $outreach)
    {
        abort_if(Gate::denies('outreach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outreach->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
