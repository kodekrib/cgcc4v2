@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.atsMembershipRecord.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ats-membership-records.update", [$atsMembershipRecord->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ats_membership_no">{{ trans('cruds.atsMembershipRecord.fields.ats_membership_no') }}</label>
                <input class="form-control {{ $errors->has('ats_membership_no') ? 'is-invalid' : '' }}" type="text" name="ats_membership_no" id="ats_membership_no" value="{{ old('ats_membership_no', $atsMembershipRecord->ats_membership_no) }}">
                @if($errors->has('ats_membership_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ats_membership_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembershipRecord.fields.ats_membership_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="names">{{ trans('cruds.atsMembershipRecord.fields.names') }}</label>
                <input class="form-control {{ $errors->has('names') ? 'is-invalid' : '' }}" type="text" name="names" id="names" value="{{ old('names', $atsMembershipRecord->names) }}">
                @if($errors->has('names'))
                    <div class="invalid-feedback">
                        {{ $errors->first('names') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembershipRecord.fields.names_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="classes">{{ trans('cruds.atsMembershipRecord.fields.classes') }}</label>
                <input class="form-control {{ $errors->has('classes') ? 'is-invalid' : '' }}" type="text" name="classes" id="classes" value="{{ old('classes', $atsMembershipRecord->classes) }}">
                @if($errors->has('classes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('classes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembershipRecord.fields.classes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="batch">{{ trans('cruds.atsMembershipRecord.fields.batch') }}</label>
                <input class="form-control {{ $errors->has('batch') ? 'is-invalid' : '' }}" type="text" name="batch" id="batch" value="{{ old('batch', $atsMembershipRecord->batch) }}">
                @if($errors->has('batch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembershipRecord.fields.batch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year">{{ trans('cruds.atsMembershipRecord.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="number" name="year" id="year" value="{{ old('year', $atsMembershipRecord->year) }}" step="1">
                @if($errors->has('year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembershipRecord.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="month">{{ trans('cruds.atsMembershipRecord.fields.month') }}</label>
                <input class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" type="text" name="month" id="month" value="{{ old('month', $atsMembershipRecord->month) }}">
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembershipRecord.fields.month_helper') }}</span>
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