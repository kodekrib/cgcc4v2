@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.atsMembershipRecord.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ats-membership-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.id') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.ats_membership_no') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->ats_membership_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.names') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->names }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.classes') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->classes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.batch') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->batch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.year') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.month') }}
                        </th>
                        <td>
                            {{ $atsMembershipRecord->month }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ats-membership-records.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection