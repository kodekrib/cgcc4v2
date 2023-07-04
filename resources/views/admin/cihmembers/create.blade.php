@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cihmember.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cihmembers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="zone_id">{{ trans('cruds.cihmember.fields.zone') }}</label>
                <select class="form-control select2 {{ $errors->has('zone') ? 'is-invalid' : '' }}" name="zone_id" id="zone_id">
                    @foreach($zones as $id => $entry)
                        <option value="{{ $id }}" {{ old('zone_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihmember.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cih_id">{{ trans('cruds.cihmember.fields.cih') }}</label>
                <select class="form-control select2 {{ $errors->has('cih') ? 'is-invalid' : '' }}" name="cih_id" id="cih_id">
                    @foreach($cihs as $id => $entry)
                        <option value="{{ $id }}" {{ old('cih_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cih'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cih') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihmember.fields.cih_helper') }}</span>
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