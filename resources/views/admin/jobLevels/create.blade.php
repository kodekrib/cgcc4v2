@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jobLevel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-levels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="job_level">{{ trans('cruds.jobLevel.fields.job_level') }}</label>
                <input class="form-control {{ $errors->has('job_level') ? 'is-invalid' : '' }}" type="text" name="job_level" id="job_level" value="{{ old('job_level', '') }}">
                @if($errors->has('job_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobLevel.fields.job_level_helper') }}</span>
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