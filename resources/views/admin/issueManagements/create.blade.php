@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.issueManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.issue-managements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.issueManagement.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_title">{{ trans('cruds.issueManagement.fields.issue_title') }}</label>
                <input class="form-control {{ $errors->has('issue_title') ? 'is-invalid' : '' }}" type="text" name="issue_title" id="issue_title" value="{{ old('issue_title', '') }}">
                @if($errors->has('issue_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issue_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.issue_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_description">{{ trans('cruds.issueManagement.fields.issue_description') }}</label>
                <textarea class="form-control {{ $errors->has('issue_description') ? 'is-invalid' : '' }}" name="issue_description" id="issue_description">{{ old('issue_description') }}</textarea>
                @if($errors->has('issue_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issue_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.issue_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_location_id">{{ trans('cruds.issueManagement.fields.issue_location') }}</label>
                <select class="form-control select2 {{ $errors->has('issue_location') ? 'is-invalid' : '' }}" name="issue_location_id" id="issue_location_id">
                    @foreach($issue_locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('issue_location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('issue_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issue_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.issue_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="department_concerned_id">{{ trans('cruds.issueManagement.fields.department_concerned') }}</label>
                <select class="form-control select2 {{ $errors->has('department_concerned') ? 'is-invalid' : '' }}" name="department_concerned_id" id="department_concerned_id">
                    @foreach($department_concerneds as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_concerned_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department_concerned'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department_concerned') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.department_concerned_helper') }}</span>
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