@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.joinDepartment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.join-departments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.id') }}
                        </th>
                        <td>
                            {{ $joinDepartment->id }}
                        </td>
                    </tr>


                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.member_name') }}
                        </th>
                        <td>
                            {{ $joinDepartment->member->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.member_Email') }}
                        </th>
                        <td>
                            {{ $joinDepartment->member->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.member_phoneNumber') }}
                        </th>
                        <td>
                            {{ $joinDepartment->member->mobile ?? '' }}
                        </td>
                    </tr>


                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.department') }}
                        </th>
                        <td>
                            {{ $joinDepartment->department->department_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.member_type') }}
                        </th>
                        <td>
                            {{ App\Models\JoinDepartment::MEMBER_TYPE_SELECT[$joinDepartment->member_type] ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.primary_function') }}
                        </th>
                        <td>
                            {{ App\Models\JoinDepartment::PRIMARY_FUNCTION_SELECT[$joinDepartment->primary_function] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.approval_status') }}
                        </th>
                        <td>
                            <!-- <input type="checkbox" disabled="disabled" {{ $joinDepartment->approval_status ? 'checked' : '' }}> -->
                            @if($joinDepartment->approval_status == 0)
                                Pending
                            @elseif( $joinDepartment->approval_status == 1)
                                Disapproved
                            @else
                                Approved
                            @endif

                        </td>
                    </tr>
                     <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $joinDepartment->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                   <!-- <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.disapproved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $joinDepartment->disapproved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.delisted') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $joinDepartment->delisted ? 'checked' : '' }}>
                        </td>
                    </tr> -->
                    <tr>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.reason') }}
                        </th>
                        <td>
                            {{ $joinDepartment->reason??'N/A' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.join-departments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
