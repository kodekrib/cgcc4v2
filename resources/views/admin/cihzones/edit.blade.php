@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cihzone.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cihzones.update", [$cihzone->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="zone">{{ trans('cruds.cihzone.fields.zone') }}</label>
                <input class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" type="text" name="zone" id="zone" value="{{ old('zone', $cihzone->zone) }}" required>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zone_area">{{ trans('cruds.cihzone.fields.zone_area') }}</label>
                <input class="form-control {{ $errors->has('zone_area') ? 'is-invalid' : '' }}" type="text" name="zone_area" id="zone_area" value="{{ old('zone_area', $cihzone->zone_area) }}" required>
                @if($errors->has('zone_area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone_area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.zone_area_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="coordinator_id">{{ trans('cruds.cihzone.fields.coordinator') }}</label>
                <select class="form-control select2 {{ $errors->has('coordinator') ? 'is-invalid' : '' }}" name="coordinator_id" id="coordinator_id" required>
                    @foreach($coordinators as $id => $entry)
                        <option value="{{ $id }}" {{ (old('coordinator_id') ? old('coordinator_id') : $cihzone->coordinator->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('coordinator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coordinator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.coordinator_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $cihzone->active || old('active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.cihzone.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('inactive') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="inactive" value="0">
                    <input class="form-check-input" type="checkbox" name="inactive" id="inactive" value="1" {{ $cihzone->inactive || old('inactive', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="inactive">{{ trans('cruds.cihzone.fields.inactive') }}</label>
                </div>
                @if($errors->has('inactive'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inactive') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.inactive_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('cancelled') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="cancelled" value="0">
                    <input class="form-check-input" type="checkbox" name="cancelled" id="cancelled" value="1" {{ $cihzone->cancelled || old('cancelled', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="cancelled">{{ trans('cruds.cihzone.fields.cancelled') }}</label>
                </div>
                @if($errors->has('cancelled'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cancelled') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.cancelled_helper') }}</span>
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