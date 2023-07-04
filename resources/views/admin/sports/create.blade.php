@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sport.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sports">{{ trans('cruds.sport.fields.sports') }}</label>
                <input class="form-control {{ $errors->has('sports') ? 'is-invalid' : '' }}" type="text" name="sports" id="sports" value="{{ old('sports', '') }}">
                @if($errors->has('sports'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sports') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sport.fields.sports_helper') }}</span>
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