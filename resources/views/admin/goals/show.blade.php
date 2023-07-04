@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.goal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.goals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.id') }}
                        </th>
                        <td>
                            {{ $goal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.date') }}
                        </th>
                        <td>
                            {{ $goal->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.goal_name') }}
                        </th>
                        <td>
                            {{ $goal->goal_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.note') }}
                        </th>
                        <td>
                            {!! $goal->note !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.achievement_date') }}
                        </th>
                        <td>
                            {{ $goal->achievement_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.goal_kpi') }}
                        </th>
                        <td>
                            {{ $goal->goal_kpi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.open') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $goal->open ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.in_progress') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $goal->in_progress ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.not_archieved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $goal->not_archieved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.closed') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $goal->closed ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.goals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection