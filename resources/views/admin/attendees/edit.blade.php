@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.attendee.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendees.update", [$attendee->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="attendees">{{ trans('cruds.attendee.fields.attendees') }}</label>
                <input class="form-control {{ $errors->has('attendees') ? 'is-invalid' : '' }}" type="text" name="attendees" id="attendees" value="{{ old('attendees', $attendee->attendees) }}">
                @if($errors->has('attendees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendee.fields.attendees_helper') }}</span>
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