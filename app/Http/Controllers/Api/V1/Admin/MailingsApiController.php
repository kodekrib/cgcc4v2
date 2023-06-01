<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMailingRequest;
use App\Http\Requests\UpdateMailingRequest;
use App\Http\Resources\Admin\MailingResource;
use App\Models\Mailing;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MailingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mailing_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MailingResource(Mailing::with(['area_of_specialization', 'job_level'])->get());
    }

    public function store(StoreMailingRequest $request)
    {
        $mailing = Mailing::create($request->all());

        return (new MailingResource($mailing))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Mailing $mailing)
    {
        abort_if(Gate::denies('mailing_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MailingResource($mailing->load(['area_of_specialization', 'job_level']));
    }

    public function update(UpdateMailingRequest $request, Mailing $mailing)
    {
        $mailing->update($request->all());

        return (new MailingResource($mailing))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Mailing $mailing)
    {
        abort_if(Gate::denies('mailing_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mailing->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
