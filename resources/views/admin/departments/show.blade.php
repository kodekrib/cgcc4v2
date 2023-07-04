@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.department.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.departments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.id') }}
                        </th>
                        <td>
                            {{ $department->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.dept_code') }}
                        </th>
                        <td>
                            {{ $department->dept_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.department_name') }}
                        </th>
                        <td>
                            {{ $department->department_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.department_email') }}
                        </th>
                        <td>
                            {{ $department->department_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.hod') }}
                        </th>
                        <td>
                            {{ $department->hod->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.organization_type') }}
                        </th>
                        <td>
                            {{ $department->organization_type->organization_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.inactive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $department->inactive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $department->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.department.fields.pending') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $department->pending ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.departments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#department_join_departments" role="tab" data-toggle="tab">
                {{ trans('cruds.joinDepartment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="department_join_departments">
            @includeIf('admin.departments.relationships.departmentJoinDepartments', ['joinDepartments' => $department->departmentJoinDepartments])
        </div>
    </div>
</div>

@endsection