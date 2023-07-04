@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employmentStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employment-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employment_status">{{ trans('cruds.employmentStatus.fields.employment_status') }}</label>
                <input class="form-control {{ $errors->has('employment_status') ? 'is-invalid' : '' }}" type="text" name="employment_status" id="employment_status" value="{{ old('employment_status', '') }}" required>
                @if($errors->has('employment_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employment_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentStatus.fields.employment_status_helper') }}</span>
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