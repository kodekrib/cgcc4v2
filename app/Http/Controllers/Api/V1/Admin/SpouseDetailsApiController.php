<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpouseDetailRequest;
use App\Http\Requests\UpdateSpouseDetailRequest;
use App\Http\Resources\Admin\SpouseDetailResource;
use App\Models\SpouseDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpouseDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('spouse_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpouseDetailResource(SpouseDetail::with(['created_by'])->get());
    }

    public function store(StoreSpouseDetailRequest $request)
    {
        $spouseDetail = SpouseDetail::create($request->all());

        return (new SpouseDetailResource($spouseDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SpouseDetail $spouseDetail)
    {
        abort_if(Gate::denies('spouse_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpouseDetailResource($spouseDetail->load(['created_by']));
    }

    public function update(UpdateSpouseDetailRequest $request, SpouseDetail $spouseDetail)
    {
        $spouseDetail->update($request->all());

        return (new SpouseDetailResource($spouseDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SpouseDetail $spouseDetail)
    {
        abort_if(Gate::denies('spouse_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouseDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
