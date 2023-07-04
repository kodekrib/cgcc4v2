@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.venueAccessory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.venue-accessories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="accessories">{{ trans('cruds.venueAccessory.fields.accessories') }}</label>
                <input class="form-control {{ $errors->has('accessories') ? 'is-invalid' : '' }}" type="text" name="accessories" id="accessories" value="{{ old('accessories', '') }}" required>
                @if($errors->has('accessories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accessories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.venueAccessory.fields.accessories_helper') }}</span>
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