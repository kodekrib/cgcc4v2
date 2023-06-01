<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDedicationRequest;
use App\Http\Requests\UpdateDedicationRequest;
use App\Http\Resources\Admin\DedicationResource;
use App\Models\Dedication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DedicationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dedication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DedicationResource(Dedication::with(['created_by'])->get());
    }

    public function store(StoreDedicationRequest $request)
    {
        $dedication = Dedication::create($request->all());

        return (new DedicationResource($dedication))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Dedication $dedication)
    {
        abort_if(Gate::denies('dedication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DedicationResource($dedication->load(['created_by']));
    }

    public function update(UpdateDedicationRequest $request, Dedication $dedication)
    {
        $dedication->update($request->all());

        return (new DedicationResource($dedication))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Dedication $dedication)
    {
        abort_if(Gate::denies('dedication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dedication->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
