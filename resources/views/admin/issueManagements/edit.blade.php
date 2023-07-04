@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.issueManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.issue-managements.update", [$issueManagement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.issueManagement.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $issueManagement->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_title">{{ trans('cruds.issueManagement.fields.issue_title') }}</label>
                <input class="form-control {{ $errors->has('issue_title') ? 'is-invalid' : '' }}" type="text" name="issue_title" id="issue_title" value="{{ old('issue_title', $issueManagement->issue_title) }}">
                @if($errors->has('issue_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issue_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.issue_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_description">{{ trans('cruds.issueManagement.fields.issue_description') }}</label>
                <textarea class="form-control {{ $errors->has('issue_description') ? 'is-invalid' : '' }}" name="issue_description" id="issue_description">{{ old('issue_description', $issueManagement->issue_description) }}</textarea>
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
                        <option value="{{ $id }}" {{ (old('issue_location_id') ? old('issue_location_id') : $issueManagement->issue_location->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('department_concerned_id') ? old('department_concerned_id') : $issueManagement->department_concerned->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <div class="form-check {{ $errors->has('open') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="open" value="0">
                    <input class="form-check-input" type="checkbox" name="open" id="open" value="1" {{ $issueManagement->open || old('open', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="open">{{ trans('cruds.issueManagement.fields.open') }}</label>
                </div>
                @if($errors->has('open'))
                    <div class="invalid-feedback">
                        {{ $errors->first('open') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.open_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('work_in_progress') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="work_in_progress" value="0">
                    <input class="form-check-input" type="checkbox" name="work_in_progress" id="work_in_progress" value="1" {{ $issueManagement->work_in_progress || old('work_in_progress', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="work_in_progress">{{ trans('cruds.issueManagement.fields.work_in_progress') }}</label>
                </div>
                @if($errors->has('work_in_progress'))
                    <div class="invalid-feedback">
                        {{ $errors->first('work_in_progress') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.work_in_progress_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('closed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="closed" value="0">
                    <input class="form-check-input" type="checkbox" name="closed" id="closed" value="1" {{ $issueManagement->closed || old('closed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="closed">{{ trans('cruds.issueManagement.fields.closed') }}</label>
                </div>
                @if($errors->has('closed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('closed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.issueManagement.fields.closed_helper') }}</span>
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