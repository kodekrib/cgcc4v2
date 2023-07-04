<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Http\Resources\Admin\QualificationResource;
use App\Models\Qualification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QualificationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qualification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QualificationResource(Qualification::with(['highest_qualifications', 'created_by'])->get());
    }

    public function store(StoreQualificationRequest $request)
    {
        $qualification = Qualification::create($request->all());

        return (new QualificationResource($qualification))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QualificationResource($qualification->load(['highest_qualifications', 'created_by']));
    }

    public function update(UpdateQualificationRequest $request, Qualification $qualification)
    {
        $qualification->update($request->all());

        return (new QualificationResource($qualification))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualification->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
