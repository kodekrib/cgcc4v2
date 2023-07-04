@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.accessibilityFeature.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accessibility-features.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accessibilityFeature.fields.id') }}
                        </th>
                        <td>
                            {{ $accessibilityFeature->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accessibilityFeature.fields.name') }}
                        </th>
                        <td>
                            {{ $accessibilityFeature->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.accessibility-features.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection