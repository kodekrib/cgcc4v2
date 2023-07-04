@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.organizationType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.organization-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="organization_type">{{ trans('cruds.organizationType.fields.organization_type') }}</label>
                <input class="form-control {{ $errors->has('organization_type') ? 'is-invalid' : '' }}" type="text" name="organization_type" id="organization_type" value="{{ old('organization_type', '') }}" required>
                @if($errors->has('organization_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organization_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizationType.fields.organization_type_helper') }}</span>
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