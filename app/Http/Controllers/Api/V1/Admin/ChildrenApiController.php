<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Http\Resources\Admin\ChildResource;
use App\Models\Child;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChildrenApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('child_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChildResource(Child::with(['father_name', 'mothers_name', 'created_by'])->get());
    }

    public function store(StoreChildRequest $request)
    {
        $child = Child::create($request->all());

        return (new ChildResource($child))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Child $child)
    {
        abort_if(Gate::denies('child_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChildResource($child->load(['father_name', 'mothers_name', 'created_by']));
    }

    public function update(UpdateChildRequest $request, Child $child)
    {
        $child->update($request->all());

        return (new ChildResource($child))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Child $child)
    {
        abort_if(Gate::denies('child_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
