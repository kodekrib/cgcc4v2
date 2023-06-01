@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.centre.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.centres.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.centre.fields.id') }}
                        </th>
                        <td>
                            {{ $centre->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.centre.fields.name') }}
                        </th>
                        <td>
                            {{ $centre->name->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.centre.fields.cih_centre') }}
                        </th>
                        <td>
                            {{ $centre->cih_centre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.centre.fields.role') }}
                        </th>
                        <td>
                            {{ $centre->role->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.centres.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection