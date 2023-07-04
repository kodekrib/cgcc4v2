<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAtsMembershipRequest;
use App\Http\Requests\UpdateAtsMembershipRequest;
use App\Http\Resources\Admin\AtsMembershipResource;
use App\Models\AtsMembership;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtsMembershipApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ats_membership_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtsMembershipResource(AtsMembership::with(['created_by', 'ats_membership_number'])->get());
    }

    public function store(StoreAtsMembershipRequest $request)
    {
        $atsMembership = AtsMembership::create($request->all());

        return (new AtsMembershipResource($atsMembership))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AtsMembership $atsMembership)
    {
        abort_if(Gate::denies('ats_membership_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtsMembershipResource($atsMembership->load(['created_by', 'ats_membership_number']));
    }

    public function update(UpdateAtsMembershipRequest $request, AtsMembership $atsMembership)
    {
        $atsMembership->update($request->all());

        return (new AtsMembershipResource($atsMembership))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AtsMembership $atsMembership)
    {
        abort_if(Gate::denies('ats_membership_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atsMembership->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
