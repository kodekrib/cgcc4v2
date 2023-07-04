<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDepartmentRequest;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Member;
use App\Models\OrganizationType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::with(['hod', 'organization_type', 'created_by'])->get();

        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        abort_if(Gate::denies('department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hods = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organization_types = OrganizationType::pluck('organization_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.departments.create', compact('hods', 'organization_types'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->all());

        return redirect()->route('admin.departments.index');
    }

    public function edit(Department $department)
    {
        abort_if(Gate::denies('department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hods = Member::pluck('member_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organization_types = OrganizationType::pluck('organization_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department->load('hod', 'organization_type', 'created_by');

        return view('admin.departments.edit', compact('department', 'hods', 'organization_types'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->all());

        return redirect()->route('admin.departments.index');
    }

    public function show(Department $department)
    {
        abort_if(Gate::denies('department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->load('hod', 'organization_type', 'created_by', 'departmentJoinDepartments');

        return view('admin.departments.show', compact('department'));
    }

    public function destroy(Department $department)
    {
        abort_if(Gate::denies('department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $department->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartmentRequest $request)
    {
        $departments = Department::find(request('ids'));

        foreach ($departments as $department) {
            $department->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getDepartmentList(){

        return  Department::with(['hod', 'organization_type', 'created_by'])->get();
    }
}
