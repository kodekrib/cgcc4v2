<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndustrySectorRequest;
use App\Http\Requests\UpdateIndustrySectorRequest;
use App\Http\Resources\Admin\IndustrySectorResource;
use App\Models\IndustrySector;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndustrySectorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('industry_sector_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IndustrySectorResource(IndustrySector::all());
    }

    public function store(StoreIndustrySectorRequest $request)
    {
        $industrySector = IndustrySector::create($request->all());

        return (new IndustrySectorResource($industrySector))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IndustrySector $industrySector)
    {
        abort_if(Gate::denies('industry_sector_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IndustrySectorResource($industrySector);
    }

    public function update(UpdateIndustrySectorRequest $request, IndustrySector $industrySector)
    {
        $industrySector->update($request->all());

        return (new IndustrySectorResource($industrySector))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IndustrySector $industrySector)
    {
        abort_if(Gate::denies('industry_sector_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industrySector->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
