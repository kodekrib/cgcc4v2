<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInterestRequest;
use App\Http\Requests\UpdateInterestRequest;
use App\Http\Resources\Admin\InterestResource;
use App\Models\Interest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InterestsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('interest_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InterestResource(Interest::with(['interests', 'industry_sector', 'created_by'])->get());
    }

    public function store(StoreInterestRequest $request)
    {
        $interest = Interest::create($request->all());
        $interest->interests()->sync($request->input('interests', []));

        return (new InterestResource($interest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Interest $interest)
    {
        abort_if(Gate::denies('interest_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InterestResource($interest->load(['interests', 'industry_sector', 'created_by']));
    }

    public function update(UpdateInterestRequest $request, Interest $interest)
    {
        $interest->update($request->all());
        $interest->interests()->sync($request->input('interests', []));

        return (new InterestResource($interest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Interest $interest)
    {
        abort_if(Gate::denies('interest_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $interest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
