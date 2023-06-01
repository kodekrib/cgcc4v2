@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bankAccountDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bank-account-details.update", [$bankAccountDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="account_name">{{ trans('cruds.bankAccountDetail.fields.account_name') }}</label>
                <input class="form-control {{ $errors->has('account_name') ? 'is-invalid' : '' }}" type="text" name="account_name" id="account_name" value="{{ old('account_name', $bankAccountDetail->account_name) }}">
                @if($errors->has('account_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccountDetail.fields.account_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="account_type_id">{{ trans('cruds.bankAccountDetail.fields.account_type') }}</label>
                <select class="form-control select2 {{ $errors->has('account_type') ? 'is-invalid' : '' }}" name="account_type_id" id="account_type_id">
                    @foreach($account_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('account_type_id') ? old('account_type_id') : $bankAccountDetail->account_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('account_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccountDetail.fields.account_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency_id">{{ trans('cruds.bankAccountDetail.fields.currency') }}</label>
                <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency_id" id="currency_id">
                    @foreach($currencies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('currency_id') ? old('currency_id') : $bankAccountDetail->currency->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('currency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccountDetail.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="account_number">{{ trans('cruds.bankAccountDetail.fields.account_number') }}</label>
                <input class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}" type="text" name="account_number" id="account_number" value="{{ old('account_number', $bankAccountDetail->account_number) }}">
                @if($errors->has('account_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccountDetail.fields.account_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sort_code">{{ trans('cruds.bankAccountDetail.fields.sort_code') }}</label>
                <input class="form-control {{ $errors->has('sort_code') ? 'is-invalid' : '' }}" type="text" name="sort_code" id="sort_code" value="{{ old('sort_code', $bankAccountDetail->sort_code) }}">
                @if($errors->has('sort_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccountDetail.fields.sort_code_helper') }}</span>
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