@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.venue.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.venues.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="venue_name">{{ trans('cruds.venue.fields.venue_name') }}</label>
                <input class="form-control {{ $errors->has('venue_name') ? 'is-invalid' : '' }}" type="text" name="venue_name" id="venue_name" value="{{ old('venue_name', '') }}" required>
                @if($errors->has('venue_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venue_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.venue_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="venue_description">{{ trans('cruds.venue.fields.venue_description') }}</label>
                <textarea class="form-control {{ $errors->has('venue_description') ? 'is-invalid' : '' }}" name="venue_description" id="venue_description">{{ old('venue_description') }}</textarea>
                @if($errors->has('venue_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venue_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.venue_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="accessories_equipments">{{ trans('cruds.venue.fields.accessories_equipment') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('accessories_equipments') ? 'is-invalid' : '' }}" name="accessories_equipments[]" id="accessories_equipments" multiple required>
                    @foreach($accessories_equipments as $id => $accessories_equipment)
                        <option value="{{ $id }}" {{ in_array($id, old('accessories_equipments', [])) ? 'selected' : '' }}>{{ $accessories_equipment }}</option>
                    @endforeach
                </select>
                @if($errors->has('accessories_equipments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accessories_equipments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.accessories_equipment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="accessibility_features">{{ trans('cruds.venue.fields.accessibility_features') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('accessibility_features') ? 'is-invalid' : '' }}" name="accessibility_features[]" id="accessibility_features" multiple>
                    @foreach($accessibility_features as $id => $accessibility_feature)
                        <option value="{{ $id }}" {{ in_array($id, old('accessibility_features', [])) ? 'selected' : '' }}>{{ $accessibility_feature }}</option>
                    @endforeach
                </select>
                @if($errors->has('accessibility_features'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accessibility_features') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.accessibility_features_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="venue_capacity">{{ trans('cruds.venue.fields.venue_capacity') }}</label>
                <input class="form-control {{ $errors->has('venue_capacity') ? 'is-invalid' : '' }}" type="number" name="venue_capacity" id="venue_capacity" value="{{ old('venue_capacity', '') }}" step="1" required>
                @if($errors->has('venue_capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venue_capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.venue_capacity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="size">{{ trans('cruds.venue.fields.size') }}</label>
                <input class="form-control {{ $errors->has('size') ? 'is-invalid' : '' }}" type="number" name="size" id="size" value="{{ old('size', '') }}" step="1">
                @if($errors->has('size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.size_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="venue_location_id">{{ trans('cruds.venue.fields.venue_location') }}</label>
                <select class="form-control select2 {{ $errors->has('venue_location') ? 'is-invalid' : '' }}" name="venue_location_id" id="venue_location_id" required>
                    @foreach($venue_locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('venue_location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('venue_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venue_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venue.fields.venue_location_helper') }}</span>
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