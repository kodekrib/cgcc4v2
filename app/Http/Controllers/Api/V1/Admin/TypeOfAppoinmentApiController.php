<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfAppoinmentRequest;
use App\Http\Requests\UpdateTypeOfAppoinmentRequest;
use App\Http\Resources\Admin\TypeOfAppoinmentResource;
use App\Models\TypeOfAppoinment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfAppoinmentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_appoinment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfAppoinmentResource(TypeOfAppoinment::with(['created_by'])->get());
    }

    public function store(StoreTypeOfAppoinmentRequest $request)
    {
        $typeOfAppoinment = TypeOfAppoinment::create($request->all());

        return (new TypeOfAppoinmentResource($typeOfAppoinment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOfAppoinment $typeOfAppoinment)
    {
        abort_if(Gate::denies('type_of_appoinment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfAppoinmentResource($typeOfAppoinment->load(['created_by']));
    }

    public function update(UpdateTypeOfAppoinmentRequest $request, TypeOfAppoinment $typeOfAppoinment)
    {
        $typeOfAppoinment->update($request->all());

        return (new TypeOfAppoinmentResource($typeOfAppoinment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOfAppoinment $typeOfAppoinment)
    {
        abort_if(Gate::denies('type_of_appoinment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfAppoinment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
