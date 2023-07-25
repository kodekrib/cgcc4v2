@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.joinDepartment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.join-departments.update", [$joinDepartment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
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

            <div class="form-group">
                <label class="required" for="member_name">{{ trans('cruds.joinDepartment.fields.member_name') }}</label>
                <input class="form-control {{ $errors->has('member') ? 'is-invalid' : '' }}" disabled type="text" name="member_name" id="member_name" value="{{{ $joinDepartment->member->member_name }}}">
            </div>
            <div class="form-group">
                <label class="required" for="member_name">{{ trans('cruds.joinDepartment.fields.member_Email') }}</label>
                <input class="form-control {{ $errors->has('member') ? 'is-invalid' : '' }}" disabled type="text" name="email" id="email" value="{{{ $joinDepartment->member->email }}}">
            </div>
            <div class="form-group">
                <label class="required" for="member_name">{{ trans('cruds.joinDepartment.fields.member_phoneNumber') }}</label>
                <input class="form-control {{ $errors->has('member') ? 'is-invalid' : '' }}" disabled type="text" name="mobile" id="mobile" value="{{{ $joinDepartment->member->mobile }}}">
            </div>
            <div class="form-group">
                <label class="required" for="department_id">{{ trans('cruds.joinDepartment.fields.department') }}</label>
                <select class="form-control select2 {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department_id" id="department_id" required>
                    @foreach($departments as $id => $entry)
                        <option value="{{ $id }}" {{ (old('department_id') ? old('department_id') : $joinDepartment->department->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label>{{ trans('cruds.joinDepartment.fields.member_type') }}</label>
                <select class="form-control {{ $errors->has('member_type') ? 'is-invalid' : '' }}" name="member_type" id="member_type">
                    <option value disabled {{ old('member_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\JoinDepartment::MEMBER_TYPE_SELECT as $key => $label)

                            <option value="{{ $key }}" {{ old('member_type', $joinDepartment->member_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>

                    @endforeach
                </select>
                @if($errors->has('member_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.joinDepartment.fields.member_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.joinDepartment.fields.primary_function') }}</label>
                <select class="form-control {{ $errors->has('primary_function') ? 'is-invalid' : '' }}" name="primary_function" id="primary_function">
                    <option value disabled {{ old('primary_function', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\JoinDepartment::PRIMARY_FUNCTION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('primary_function', $joinDepartment->primary_function) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('primary_function'))
                    <div class="invalid-feedback">
                        {{ $errors->first('primary_function') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.joinDepartment.fields.primary_function_helper') }}</span>
            </div>
            @if($joinDepartment->approval_status == 0)
                <div class="form-group">
                    <label>{{ trans('cruds.joinDepartment.fields.approval_status') }}</label>
                    <select class="form-control {{ $errors->has('approval_status') ? 'is-invalid' : '' }}" name="approval_status" id="approval_status">
                        <option value disabled {{ old('approval_status', $joinDepartment->approval_status) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\JoinDepartment::APPROVAL_STATUS as $key => $label)
                            @if($key != '3')
                            <option value="{{ $key }}" {{ old('approval_status', $joinDepartment->approval_status) === (integer) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endif

                        @endforeach
                    </select>
                    @if($errors->has('approval_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('approval_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.joinDepartment.fields.primary_function_helper') }}</span>
                </div>
            @endif

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
