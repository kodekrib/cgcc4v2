<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCihRequestRequest;
use App\Http\Requests\StoreCihRequestRequest;
use App\Http\Requests\UpdateCihRequestRequest;
use App\Models\CihRequest;
use App\Models\CihTypesOfRequest;
use App\Models\Member;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CihRequestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cih_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihRequests = CihRequest::with(['requester_name', 'types_of_request'])->get();

        return view('admin.cihRequests.index', compact('cihRequests'));
    }

    public function create()
    {
        abort_if(Gate::denies('cih_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requester_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types_of_requests = CihTypesOfRequest::pluck('types_of_request', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cihRequests.create', compact('requester_names', 'types_of_requests'));
    }

    public function store(StoreCihRequestRequest $request)
    {
        $cihRequest = CihRequest::create($request->all());

        return redirect()->route('admin.cih-requests.index');
    }

    public function edit(CihRequest $cihRequest)
    {
        abort_if(Gate::denies('cih_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requester_names = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types_of_requests = CihTypesOfRequest::pluck('types_of_request', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cihRequest->load('requester_name', 'types_of_request');

        return view('admin.cihRequests.edit', compact('cihRequest', 'requester_names', 'types_of_requests'));
    }

    public function update(UpdateCihRequestRequest $request, CihRequest $cihRequest)
    {
        $cihRequest->update($request->all());

        return redirect()->route('admin.cih-requests.index');
    }

    public function show(CihRequest $cihRequest)
    {
        abort_if(Gate::denies('cih_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihRequest->load('requester_name', 'types_of_request');

        return view('admin.cihRequests.show', compact('cihRequest'));
    }

    public function destroy(CihRequest $cihRequest)
    {
        abort_if(Gate::denies('cih_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cihRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyCihRequestRequest $request)
    {
        CihRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
