@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cihRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cih-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $cihRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.date_of_request') }}
                        </th>
                        <td>
                            {{ $cihRequest->date_of_request }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.requester_name') }}
                        </th>
                        <td>
                            {{ $cihRequest->requester_name->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.types_of_request') }}
                        </th>
                        <td>
                            {{ $cihRequest->types_of_request->types_of_request ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.date_of_request_event') }}
                        </th>
                        <td>
                            {{ $cihRequest->date_of_request_event }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.approve') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cihRequest->approve ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.decline') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cihRequest->decline ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cihRequest.fields.pending') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $cihRequest->pending ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cih-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection