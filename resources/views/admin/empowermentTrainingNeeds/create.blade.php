@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.empowermentTrainingNeed.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.empowerment-training-needs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="training_needs">{{ trans('cruds.empowermentTrainingNeed.fields.training_needs') }}</label>
                <input class="form-control {{ $errors->has('training_needs') ? 'is-invalid' : '' }}" type="text" name="training_needs" id="training_needs" value="{{ old('training_needs', '') }}">
                @if($errors->has('training_needs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('training_needs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowermentTrainingNeed.fields.training_needs_helper') }}</span>
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