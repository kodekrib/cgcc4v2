@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.christening.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.christenings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="parent">{{ trans('cruds.christening.fields.parent') }}</label>
                <input class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" type="text" name="parent" id="parent" value="{{ old('parent', '') }}">
                @if($errors->has('parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_at_birth">{{ trans('cruds.christening.fields.no_at_birth') }}</label>
                <input class="form-control {{ $errors->has('no_at_birth') ? 'is-invalid' : '' }}" type="number" name="no_at_birth" id="no_at_birth" value="{{ old('no_at_birth', '') }}" step="1">
                @if($errors->has('no_at_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_at_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.no_at_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.christening.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Christening::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.christening.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ceremony_location">{{ trans('cruds.christening.fields.ceremony_location') }}</label>
                <textarea class="form-control {{ $errors->has('ceremony_location') ? 'is-invalid' : '' }}" name="ceremony_location" id="ceremony_location">{{ old('ceremony_location') }}</textarea>
                @if($errors->has('ceremony_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ceremony_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.ceremony_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zone_id">{{ trans('cruds.christening.fields.zone') }}</label>
                <select class="form-control select2 {{ $errors->has('zone') ? 'is-invalid' : '' }}" name="zone_id" id="zone_id">
                    @foreach($zones as $id => $entry)
                        <option value="{{ $id }}" {{ old('zone_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ceremony_time">{{ trans('cruds.christening.fields.ceremony_time') }}</label>
                <input class="form-control datetime {{ $errors->has('ceremony_time') ? 'is-invalid' : '' }}" type="text" name="ceremony_time" id="ceremony_time" value="{{ old('ceremony_time') }}">
                @if($errors->has('ceremony_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ceremony_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.christening.fields.ceremony_time_helper') }}</span>
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