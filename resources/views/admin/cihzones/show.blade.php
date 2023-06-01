@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cihzone.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cihzones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.id') }}
                        </th>
                        <td>
                            {{ $cihzone->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.zone') }}
                        </th>
                        <td>
                            {{ $cihzone->zone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.zone_area') }}
                        </th>
                        <td>
                            {{ $cihzone->zone_area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.coordinator') }}
                        </th>
                        <td>
                            {{ $cihzone->coordinator->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cihzone->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.inactive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cihzone->inactive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihzone.fields.cancelled') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cihzone->cancelled ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cihzones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection