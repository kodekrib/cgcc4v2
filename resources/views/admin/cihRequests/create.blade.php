@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cihRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cih-requests.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date_of_request">{{ trans('cruds.cihRequest.fields.date_of_request') }}</label>
                <input class="form-control date {{ $errors->has('date_of_request') ? 'is-invalid' : '' }}" type="text" name="date_of_request" id="date_of_request" value="{{ old('date_of_request') }}">
                @if($errors->has('date_of_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.date_of_request_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="requester_name_id">{{ trans('cruds.cihRequest.fields.requester_name') }}</label>
                <select class="form-control select2 {{ $errors->has('requester_name') ? 'is-invalid' : '' }}" name="requester_name_id" id="requester_name_id">
                    @foreach($requester_names as $id => $entry)
                        <option value="{{ $id }}" {{ old('requester_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('requester_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requester_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.requester_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="types_of_request_id">{{ trans('cruds.cihRequest.fields.types_of_request') }}</label>
                <select class="form-control select2 {{ $errors->has('types_of_request') ? 'is-invalid' : '' }}" name="types_of_request_id" id="types_of_request_id">
                    @foreach($types_of_requests as $id => $entry)
                        <option value="{{ $id }}" {{ old('types_of_request_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('types_of_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('types_of_request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.types_of_request_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_request_event">{{ trans('cruds.cihRequest.fields.date_of_request_event') }}</label>
                <input class="form-control date {{ $errors->has('date_of_request_event') ? 'is-invalid' : '' }}" type="text" name="date_of_request_event" id="date_of_request_event" value="{{ old('date_of_request_event') }}">
                @if($errors->has('date_of_request_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_request_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.date_of_request_event_helper') }}</span>
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