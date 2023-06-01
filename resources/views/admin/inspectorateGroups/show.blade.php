@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.inspectorateGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inspectorate-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $inspectorateGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.surname') }}
                        </th>
                        <td>
                            {{ $inspectorateGroup->surname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.first_name') }}
                        </th>
                        <td>
                            {{ $inspectorateGroup->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.group') }}
                        </th>
                        <td>
                            {{ $inspectorateGroup->group->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.inspectorate-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection