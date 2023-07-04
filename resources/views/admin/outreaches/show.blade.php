@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.outreach.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.outreaches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.id') }}
                        </th>
                        <td>
                            {{ $outreach->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.type') }}
                        </th>
                        <td>
                            {{ $outreach->type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.name') }}
                        </th>
                        <td>
                            {{ $outreach->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.description') }}
                        </th>
                        <td>
                            {{ $outreach->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.date') }}
                        </th>
                        <td>
                            {{ $outreach->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.time') }}
                        </th>
                        <td>
                            {{ $outreach->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.location') }}
                        </th>
                        <td>
                            {{ $outreach->location->location ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.contact_person') }}
                        </th>
                        <td>
                            {{ $outreach->contact_person->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $outreach->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outreach.fields.completed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $outreach->completed ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.outreaches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection