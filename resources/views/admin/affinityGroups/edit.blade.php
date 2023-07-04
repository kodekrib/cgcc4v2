@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.affinityGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.affinity-groups.update", [$affinityGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="affinity_group">{{ trans('cruds.affinityGroup.fields.affinity_group') }}</label>
                <input class="form-control {{ $errors->has('affinity_group') ? 'is-invalid' : '' }}" type="text" name="affinity_group" id="affinity_group" value="{{ old('affinity_group', $affinityGroup->affinity_group) }}" required>
                @if($errors->has('affinity_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affinity_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.affinityGroup.fields.affinity_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="affinity_group_code">{{ trans('cruds.affinityGroup.fields.affinity_group_code') }}</label>
                <input class="form-control {{ $errors->has('affinity_group_code') ? 'is-invalid' : '' }}" type="text" name="affinity_group_code" id="affinity_group_code" value="{{ old('affinity_group_code', $affinityGroup->affinity_group_code) }}" required>
                @if($errors->has('affinity_group_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affinity_group_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.affinityGroup.fields.affinity_group_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="criteria">{{ trans('cruds.affinityGroup.fields.criteria') }}</label>
                <input class="form-control {{ $errors->has('criteria') ? 'is-invalid' : '' }}" type="text" name="criteria" id="criteria" value="{{ old('criteria', $affinityGroup->criteria) }}" required>
                @if($errors->has('criteria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('criteria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.affinityGroup.fields.criteria_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="head_of_group_id">{{ trans('cruds.affinityGroup.fields.head_of_group') }}</label>
                <select class="form-control select2 {{ $errors->has('head_of_group') ? 'is-invalid' : '' }}" name="head_of_group_id" id="head_of_group_id" required>
                    @foreach($head_of_groups as $id => $entry)
                        <option value="{{ $id }}" {{ (old('head_of_group_id') ? old('head_of_group_id') : $affinityGroup->head_of_group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('head_of_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('head_of_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.affinityGroup.fields.head_of_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.affinityGroup.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AffinityGroup::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $affinityGroup->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.affinityGroup.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection