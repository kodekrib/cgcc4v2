<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCentreRequest;
use App\Http\Requests\UpdateCentreRequest;
use App\Http\Resources\Admin\CentreResource;
use App\Models\Centre;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CentresApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('centre_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CentreResource(Centre::with(['name', 'role', 'created_by'])->get());
    }

    public function store(StoreCentreRequest $request)
    {
        $centre = Centre::create($request->all());

        return (new CentreResource($centre))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Centre $centre)
    {
        abort_if(Gate::denies('centre_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CentreResource($centre->load(['name', 'role', 'created_by']));
    }

    public function update(UpdateCentreRequest $request, Centre $centre)
    {
        $centre->update($request->all());

        return (new CentreResource($centre))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Centre $centre)
    {
        abort_if(Gate::denies('centre_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $centre->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
