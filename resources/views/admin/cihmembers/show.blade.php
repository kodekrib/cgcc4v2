@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cihmember.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cihmembers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.id') }}
                        </th>
                        <td>
                            {{ $cihmember->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.member_name') }}
                        </th>
                        <td>
                            {{ $cihmember->member_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Cihmember::GENDER_SELECT[$cihmember->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.email') }}
                        </th>
                        <td>
                            {{ $cihmember->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $cihmember->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.zone') }}
                        </th>
                        <td>
                            {{ $cihmember->zone->zone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihmember.fields.cih') }}
                        </th>
                        <td>
                            {{ $cihmember->cih->cih_centre ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cihmembers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection