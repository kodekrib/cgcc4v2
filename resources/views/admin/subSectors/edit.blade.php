@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subSector.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sub-sectors.update", [$subSector->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.subSector.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $subSector->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subSector.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="industry_id">{{ trans('cruds.subSector.fields.industry') }}</label>
                <select class="form-control select2 {{ $errors->has('industry') ? 'is-invalid' : '' }}" name="industry_id" id="industry_id">
                    @foreach($industries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('industry_id') ? old('industry_id') : $subSector->industry->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('industry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('industry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subSector.fields.industry_helper') }}</span>
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