@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.affinityGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.affinity-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $affinityGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.affinity_group') }}
                        </th>
                        <td>
                            {{ $affinityGroup->affinity_group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.affinity_group_code') }}
                        </th>
                        <td>
                            {{ $affinityGroup->affinity_group_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.criteria') }}
                        </th>
                        <td>
                            {{ $affinityGroup->criteria }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.head_of_group') }}
                        </th>
                        <td>
                            {{ $affinityGroup->head_of_group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.affinityGroup.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\AffinityGroup::STATUS_SELECT[$affinityGroup->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.affinity-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection