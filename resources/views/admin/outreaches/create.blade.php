@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.outreach.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.outreaches.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="type_id">{{ trans('cruds.outreach.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.outreach.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.outreach.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.outreach.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time">{{ trans('cruds.outreach.fields.time') }}</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time') }}">
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location_id">{{ trans('cruds.outreach.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id">
                    @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_person_id">{{ trans('cruds.outreach.fields.contact_person') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_person') ? 'is-invalid' : '' }}" name="contact_person_id" id="contact_person_id">
                    @foreach($contact_people as $id => $entry)
                        <option value="{{ $id }}" {{ old('contact_person_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_person'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_person') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.outreach.fields.contact_person_helper') }}</span>
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