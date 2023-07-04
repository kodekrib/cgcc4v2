@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dedication.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dedications.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="parent">{{ trans('cruds.dedication.fields.parent') }}</label>
                <input class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" type="text" name="parent" id="parent" value="{{ old('parent', '') }}">
                @if($errors->has('parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dedication.fields.parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_at_birth">{{ trans('cruds.dedication.fields.no_at_birth') }}</label>
                <input class="form-control {{ $errors->has('no_at_birth') ? 'is-invalid' : '' }}" type="number" name="no_at_birth" id="no_at_birth" value="{{ old('no_at_birth', '') }}" step="1">
                @if($errors->has('no_at_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_at_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dedication.fields.no_at_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.dedication.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dedication.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_dedication">{{ trans('cruds.dedication.fields.date_of_dedication') }}</label>
                <input class="form-control date {{ $errors->has('date_of_dedication') ? 'is-invalid' : '' }}" type="text" name="date_of_dedication" id="date_of_dedication" value="{{ old('date_of_dedication') }}">
                @if($errors->has('date_of_dedication'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_dedication') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dedication.fields.date_of_dedication_helper') }}</span>
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