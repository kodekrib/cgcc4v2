@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mountainOfInfluence.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mountain-of-influences.update", [$mountainOfInfluence->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="my_mountain_of_culture_id">{{ trans('cruds.mountainOfInfluence.fields.my_mountain_of_culture') }}</label>
                <select class="form-control select2 {{ $errors->has('my_mountain_of_culture') ? 'is-invalid' : '' }}" name="my_mountain_of_culture_id" id="my_mountain_of_culture_id">
                    @foreach($my_mountain_of_cultures as $id => $entry)
                        <option value="{{ $id }}" {{ (old('my_mountain_of_culture_id') ? old('my_mountain_of_culture_id') : $mountainOfInfluence->my_mountain_of_culture->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('my_mountain_of_culture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('my_mountain_of_culture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainOfInfluence.fields.my_mountain_of_culture_helper') }}</span>
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