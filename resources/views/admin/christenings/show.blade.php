@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.christening.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.christenings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.id') }}
                        </th>
                        <td>
                            {{ $christening->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.parent') }}
                        </th>
                        <td>
                            {{ $christening->parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.no_at_birth') }}
                        </th>
                        <td>
                            {{ $christening->no_at_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Christening::GENDER_SELECT[$christening->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $christening->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.ceremony_location') }}
                        </th>
                        <td>
                            {{ $christening->ceremony_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.zone') }}
                        </th>
                        <td>
                            {{ $christening->zone->zone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.ceremony_time') }}
                        </th>
                        <td>
                            {{ $christening->ceremony_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $christening->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.christening.fields.pending') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $christening->pending ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.christenings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection