@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.issueManagement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.issue-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.id') }}
                        </th>
                        <td>
                            {{ $issueManagement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.date') }}
                        </th>
                        <td>
                            {{ $issueManagement->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.issue_title') }}
                        </th>
                        <td>
                            {{ $issueManagement->issue_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.issue_description') }}
                        </th>
                        <td>
                            {{ $issueManagement->issue_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.issue_location') }}
                        </th>
                        <td>
                            {{ $issueManagement->issue_location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.department_concerned') }}
                        </th>
                        <td>
                            {{ $issueManagement->department_concerned->department_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.open') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $issueManagement->open ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.work_in_progress') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $issueManagement->work_in_progress ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.closed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $issueManagement->closed ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.issueManagement.fields.created_by') }}
                        </th>
                        <td>
                            {{ $issueManagement->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.issue-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection