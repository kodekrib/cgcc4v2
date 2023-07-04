@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.meetingType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.meeting-types.update", [$meetingType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="types">{{ trans('cruds.meetingType.fields.types') }}</label>
                <input class="form-control {{ $errors->has('types') ? 'is-invalid' : '' }}" type="text" name="types" id="types" value="{{ old('types', $meetingType->types) }}">
                @if($errors->has('types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meetingType.fields.types_helper') }}</span>
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