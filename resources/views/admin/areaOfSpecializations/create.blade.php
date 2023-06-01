@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.areaOfSpecialization.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.area-of-specializations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="area_of_specialization">{{ trans('cruds.areaOfSpecialization.fields.area_of_specialization') }}</label>
                <input class="form-control {{ $errors->has('area_of_specialization') ? 'is-invalid' : '' }}" type="text" name="area_of_specialization" id="area_of_specialization" value="{{ old('area_of_specialization', '') }}">
                @if($errors->has('area_of_specialization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_of_specialization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.areaOfSpecialization.fields.area_of_specialization_helper') }}</span>
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