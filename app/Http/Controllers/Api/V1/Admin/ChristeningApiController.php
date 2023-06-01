<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChristeningRequest;
use App\Http\Requests\UpdateChristeningRequest;
use App\Http\Resources\Admin\ChristeningResource;
use App\Models\Christening;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChristeningApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('christening_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChristeningResource(Christening::with(['zone', 'created_by'])->get());
    }

    public function store(StoreChristeningRequest $request)
    {
        $christening = Christening::create($request->all());

        return (new ChristeningResource($christening))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Christening $christening)
    {
        abort_if(Gate::denies('christening_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChristeningResource($christening->load(['zone', 'created_by']));
    }

    public function update(UpdateChristeningRequest $request, Christening $christening)
    {
        $christening->update($request->all());

        return (new ChristeningResource($christening))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Christening $christening)
    {
        abort_if(Gate::denies('christening_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $christening->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
