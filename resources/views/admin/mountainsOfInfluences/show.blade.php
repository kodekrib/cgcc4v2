@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mountainsOfInfluence.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mountains-of-influences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.id') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.nation') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->nation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.corresponding_mountain') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->corresponding_mountain }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.prevailing_culture') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->prevailing_culture }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.counter_culture') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->counter_culture }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.counter_culture_text') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->counter_culture_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.attributes_of_christ') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->attributes_of_christ }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.motivational_gifts') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->motivational_gifts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.mountain_leader') }}
                        </th>
                        <td>
                            {{ $mountainsOfInfluence->mountain_leader->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mountainsOfInfluence.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\MountainsOfInfluence::STATUS_SELECT[$mountainsOfInfluence->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mountains-of-influences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection