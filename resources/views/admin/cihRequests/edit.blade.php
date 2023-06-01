@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cihRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cih-requests.update", [$cihRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date_of_request">{{ trans('cruds.cihRequest.fields.date_of_request') }}</label>
                <input class="form-control date {{ $errors->has('date_of_request') ? 'is-invalid' : '' }}" type="text" name="date_of_request" id="date_of_request" value="{{ old('date_of_request', $cihRequest->date_of_request) }}">
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
                        <option value="{{ $id }}" {{ (old('requester_name_id') ? old('requester_name_id') : $cihRequest->requester_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('types_of_request_id') ? old('types_of_request_id') : $cihRequest->types_of_request->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control date {{ $errors->has('date_of_request_event') ? 'is-invalid' : '' }}" type="text" name="date_of_request_event" id="date_of_request_event" value="{{ old('date_of_request_event', $cihRequest->date_of_request_event) }}">
                @if($errors->has('date_of_request_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_request_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.date_of_request_event_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('approve') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approve" value="0">
                    <input class="form-check-input" type="checkbox" name="approve" id="approve" value="1" {{ $cihRequest->approve || old('approve', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approve">{{ trans('cruds.cihRequest.fields.approve') }}</label>
                </div>
                @if($errors->has('approve'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approve') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.approve_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('decline') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="decline" value="0">
                    <input class="form-check-input" type="checkbox" name="decline" id="decline" value="1" {{ $cihRequest->decline || old('decline', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="decline">{{ trans('cruds.cihRequest.fields.decline') }}</label>
                </div>
                @if($errors->has('decline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('decline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.decline_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pending') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pending" value="0">
                    <input class="form-check-input" type="checkbox" name="pending" id="pending" value="1" {{ $cihRequest->pending || old('pending', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pending">{{ trans('cruds.cihRequest.fields.pending') }}</label>
                </div>
                @if($errors->has('pending'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pending') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihRequest.fields.pending_helper') }}</span>
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