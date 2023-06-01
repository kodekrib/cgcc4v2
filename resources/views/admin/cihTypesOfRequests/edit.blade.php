@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cihTypesOfRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cih-types-of-requests.update", [$cihTypesOfRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="types_of_request">{{ trans('cruds.cihTypesOfRequest.fields.types_of_request') }}</label>
                <input class="form-control {{ $errors->has('types_of_request') ? 'is-invalid' : '' }}" type="text" name="types_of_request" id="types_of_request" value="{{ old('types_of_request', $cihTypesOfRequest->types_of_request) }}">
                @if($errors->has('types_of_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('types_of_request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihTypesOfRequest.fields.types_of_request_helper') }}</span>
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