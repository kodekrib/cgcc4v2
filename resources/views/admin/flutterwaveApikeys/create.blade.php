@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.flutterwaveApikey.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.flutterwave-apikeys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="public_key">{{ trans('cruds.flutterwaveApikey.fields.public_key') }}</label>
                <input class="form-control {{ $errors->has('public_key') ? 'is-invalid' : '' }}" type="text" name="public_key" id="public_key" value="{{ old('public_key', '') }}">
                @if($errors->has('public_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('public_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.flutterwaveApikey.fields.public_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="secret_key">{{ trans('cruds.flutterwaveApikey.fields.secret_key') }}</label>
                <input class="form-control {{ $errors->has('secret_key') ? 'is-invalid' : '' }}" type="text" name="secret_key" id="secret_key" value="{{ old('secret_key', '') }}">
                @if($errors->has('secret_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('secret_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.flutterwaveApikey.fields.secret_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="encryption_key">{{ trans('cruds.flutterwaveApikey.fields.encryption_key') }}</label>
                <input class="form-control {{ $errors->has('encryption_key') ? 'is-invalid' : '' }}" type="text" name="encryption_key" id="encryption_key" value="{{ old('encryption_key', '') }}">
                @if($errors->has('encryption_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('encryption_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.flutterwaveApikey.fields.encryption_key_helper') }}</span>
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