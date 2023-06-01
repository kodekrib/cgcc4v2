<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCihTypesOfRequestRequest;
use App\Http\Requests\StoreCihTypesOfRequestRequest;
use App\Http\Requests\UpdateCihTypesOfRequestRequest;
use App\Models\CihTypesOfRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihTypesOfRequestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cih_types_of_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihTypesOfRequests = CihTypesOfRequest::all();

        return view('admin.cihTypesOfRequests.index', compact('cihTypesOfRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('cih_types_of_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cihTypesOfRequests.create');
    }

    public function store(StoreCihTypesOfRequestRequest $request)
    {
        $cihTypesOfRequest = CihTypesOfRequest::create($request->all());

        return redirect()->route('admin.cih-types-of-requests.index');
    }

    public function edit(CihTypesOfRequest $cihTypesOfRequest)
    {
        abort_if(Gate::denies('cih_types_of_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cihTypesOfRequests.edit', compact('cihTypesOfRequest'));
    }

    public function update(UpdateCihTypesOfRequestRequest $request, CihTypesOfRequest $cihTypesOfRequest)
    {
        $cihTypesOfRequest->update($request->all());

        return redirect()->route('admin.cih-types-of-requests.index');
    }

    public function show(CihTypesOfRequest $cihTypesOfRequest)
    {
        abort_if(Gate::denies('cih_types_of_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cihTypesOfRequests.show', compact('cihTypesOfRequest'));
    }

    public function destroy(CihTypesOfRequest $cihTypesOfRequest)
    {
        abort_if(Gate::denies('cih_types_of_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihTypesOfRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyCihTypesOfRequestRequest $request)
    {
        CihTypesOfRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
