@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.department.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.departments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="dept_code">{{ trans('cruds.department.fields.dept_code') }}</label>
                <input class="form-control {{ $errors->has('dept_code') ? 'is-invalid' : '' }}" type="text" name="dept_code" id="dept_code" value="{{ old('dept_code', '') }}" required>
                @if($errors->has('dept_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dept_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.dept_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_name">{{ trans('cruds.department.fields.department_name') }}</label>
                <input class="form-control {{ $errors->has('department_name') ? 'is-invalid' : '' }}" type="text" name="department_name" id="department_name" value="{{ old('department_name', '') }}" required>
                @if($errors->has('department_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.department_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department_email">{{ trans('cruds.department.fields.department_email') }}</label>
                <input class="form-control {{ $errors->has('department_email') ? 'is-invalid' : '' }}" type="email" name="department_email" id="department_email" value="{{ old('department_email') }}" required>
                @if($errors->has('department_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.department_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hod_id">{{ trans('cruds.department.fields.hod') }}</label>
                <select class="form-control select2 {{ $errors->has('hod') ? 'is-invalid' : '' }}" name="hod_id" id="hod_id" required>
                    @foreach($hods as $id => $entry)
                        <option value="{{ $id }}" {{ old('hod_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hod'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hod') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.hod_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="organization_type_id">{{ trans('cruds.department.fields.organization_type') }}</label>
                <select class="form-control select2 {{ $errors->has('organization_type') ? 'is-invalid' : '' }}" name="organization_type_id" id="organization_type_id" required>
                    @foreach($organization_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('organization_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('organization_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organization_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.department.fields.organization_type_helper') }}</span>
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