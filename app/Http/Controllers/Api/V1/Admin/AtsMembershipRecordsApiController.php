<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAtsMembershipRecordRequest;
use App\Http\Requests\UpdateAtsMembershipRecordRequest;
use App\Http\Resources\Admin\AtsMembershipRecordResource;
use App\Models\AtsMembershipRecord;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtsMembershipRecordsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ats_membership_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtsMembershipRecordResource(AtsMembershipRecord::all());
    }

    public function store(StoreAtsMembershipRecordRequest $request)
    {
        $atsMembershipRecord = AtsMembershipRecord::create($request->all());

        return (new AtsMembershipRecordResource($atsMembershipRecord))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AtsMembershipRecord $atsMembershipRecord)
    {
        abort_if(Gate::denies('ats_membership_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtsMembershipRecordResource($atsMembershipRecord);
    }

    public function update(UpdateAtsMembershipRecordRequest $request, AtsMembershipRecord $atsMembershipRecord)
    {
        $atsMembershipRecord->update($request->all());

        return (new AtsMembershipRecordResource($atsMembershipRecord))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AtsMembershipRecord $atsMembershipRecord)
    {
        abort_if(Gate::denies('ats_membership_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMembershipRecord->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
