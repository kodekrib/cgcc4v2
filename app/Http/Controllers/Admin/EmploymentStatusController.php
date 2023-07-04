<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmploymentStatusRequest;
use App\Http\Requests\StoreEmploymentStatusRequest;
use App\Http\Requests\UpdateEmploymentStatusRequest;
use App\Models\EmploymentStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmploymentStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employment_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentStatuses = EmploymentStatus::all();

        return view('admin.employmentStatuses.index', compact('employmentStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('employment_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.employmentStatuses.create');
    }

    public function store(StoreEmploymentStatusRequest $request)
    {
        $employmentStatus = EmploymentStatus::create($request->all());

        return redirect()->route('admin.employment-statuses.index');
    }

    public function edit(EmploymentStatus $employmentStatus)
    {
        abort_if(Gate::denies('employment_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.employmentStatuses.edit', compact('employmentStatus'));
    }

    public function update(UpdateEmploymentStatusRequest $request, EmploymentStatus $employmentStatus)
    {
        $employmentStatus->update($request->all());

        return redirect()->route('admin.employment-statuses.index');
    }

    public function show(EmploymentStatus $employmentStatus)
    {
        abort_if(Gate::denies('employment_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.employmentStatuses.show', compact('employmentStatus'));
    }

    public function destroy(EmploymentStatus $employmentStatus)
    {
        abort_if(Gate::denies('employment_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmploymentStatusRequest $request)
    {
        EmploymentStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
