@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.maritalStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.marital-statuses.update", [$maritalStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="marital_status">{{ trans('cruds.maritalStatus.fields.marital_status') }}</label>
                <input class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" type="text" name="marital_status" id="marital_status" value="{{ old('marital_status', $maritalStatus->marital_status) }}" required>
                @if($errors->has('marital_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marital_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.maritalStatus.fields.marital_status_helper') }}</span>
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