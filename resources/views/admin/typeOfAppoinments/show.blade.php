@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.typeOfAppoinment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.type-of-appoinments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.typeOfAppoinment.fields.id') }}
                        </th>
                        <td>
                            {{ $typeOfAppoinment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.typeOfAppoinment.fields.type') }}
                        </th>
                        <td>
                            {{ $typeOfAppoinment->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Default Member
                        </th>
                        <td>
                            {{ $typeOfAppoinment->default_members->member_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Default Member Email
                        </th>
                        <td>
                            {{ $typeOfAppoinment->default_members->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Member Managing Type
                        </th>
                        <td>
                                 @foreach($typeOfAppoinment->memberManageAppointmentType as $label => $item)
                                    <span class="badge badge-info">{{ $item->member_name }}</span>
                                @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.type-of-appoinments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
