@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.centre.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.centres.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name_id">{{ trans('cruds.centre.fields.name') }}</label>
                <select class="form-control select2 {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name_id" id="name_id">
                    @foreach($names as $id => $entry)
                        <option value="{{ $id }}" {{ old('name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.centre.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cih_centre">{{ trans('cruds.centre.fields.cih_centre') }}</label>
                <textarea class="form-control {{ $errors->has('cih_centre') ? 'is-invalid' : '' }}" name="cih_centre" id="cih_centre">{{ old('cih_centre') }}</textarea>
                @if($errors->has('cih_centre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cih_centre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.centre.fields.cih_centre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="role_id">{{ trans('cruds.centre.fields.role') }}</label>
                <select class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role_id" id="role_id">
                    @foreach($roles as $id => $entry)
                        <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.centre.fields.role_helper') }}</span>
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