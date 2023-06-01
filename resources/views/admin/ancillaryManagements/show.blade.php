@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ancillaryManagement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ancillary-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ancillaryManagement.fields.id') }}
                        </th>
                        <td>
                            {{ $ancillaryManagement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ancillaryManagement.fields.date') }}
                        </th>
                        <td>
                            {{ $ancillaryManagement->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ancillaryManagement.fields.service_type') }}
                        </th>
                        <td>
                            {{ $ancillaryManagement->service_type->service_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ancillaryManagement.fields.service_description') }}
                        </th>
                        <td>
                            {!! $ancillaryManagement->service_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ancillaryManagement.fields.approve') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $ancillaryManagement->approve ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ancillaryManagement.fields.decline') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $ancillaryManagement->decline ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ancillary-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection