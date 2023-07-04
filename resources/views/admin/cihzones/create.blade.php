@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cihzone.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cihzones.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="zone">{{ trans('cruds.cihzone.fields.zone') }}</label>
                <input class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" type="text" name="zone" id="zone" value="{{ old('zone', '') }}" required>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihzone.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zone_area">{{ trans('cruds.cihzone.fields.zone_area') }}</label>
                <input class="form-control {{ $errors->has('zone_area') ? 'is-invalid' : '' }}" type="text" name="zone_area" id="zone_area" value="{{ old('zone_area', '') }}" required>
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
                        <option value="{{ $id }}" {{ old('coordinator_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection