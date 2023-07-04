@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.serviceType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.service-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="service_type">{{ trans('cruds.serviceType.fields.service_type') }}</label>
                <input class="form-control {{ $errors->has('service_type') ? 'is-invalid' : '' }}" type="text" name="service_type" id="service_type" value="{{ old('service_type', '') }}">
                @if($errors->has('service_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceType.fields.service_type_helper') }}</span>
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