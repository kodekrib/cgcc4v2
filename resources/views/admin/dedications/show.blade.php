@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dedication.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dedications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.id') }}
                        </th>
                        <td>
                            {{ $dedication->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.parent') }}
                        </th>
                        <td>
                            {{ $dedication->parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.no_at_birth') }}
                        </th>
                        <td>
                            {{ $dedication->no_at_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $dedication->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.date_of_dedication') }}
                        </th>
                        <td>
                            {{ $dedication->date_of_dedication }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.department') }}
                        </th>
                        <td>
                            {{ $dedication->department }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $dedication->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dedication.fields.pending') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $dedication->pending ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dedications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection