@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.atsMembership.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ats-memberships.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ats_membership_number_id">{{ trans('cruds.atsMembership.fields.ats_membership_number') }}</label>
                <select class="form-control select2 {{ $errors->has('ats_membership_number') ? 'is-invalid' : '' }}" name="ats_membership_number_id" id="ats_membership_number_id">
                    @foreach($ats_membership_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ old('ats_membership_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ats_membership_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ats_membership_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.atsMembership.fields.ats_membership_number_helper') }}</span>
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