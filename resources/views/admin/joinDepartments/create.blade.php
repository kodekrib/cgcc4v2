@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.joinDepartment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.join-departments.store") }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($member == null)
                <div class="alert alert-danger">
                    You are not eligible to join any Department, please register as member before joining department
                </div>
            @endif
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.joinDepartment.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.joinDepartment.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.joinDepartment.fields.primary_function') }}</label>
                <select class="form-control {{ $errors->has('primary_function') ? 'is-invalid' : '' }}" name="primary_function" id="primary_function">
                    <option value disabled {{ old('primary_function', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\JoinDepartment::PRIMARY_FUNCTION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('primary_function', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_function'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_function') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.joinDepartment.fields.primary_function_helper') }}</span>
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
