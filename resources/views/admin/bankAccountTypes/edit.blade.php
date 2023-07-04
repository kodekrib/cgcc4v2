@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bankAccountType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bank-account-types.update", [$bankAccountType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="account_type">{{ trans('cruds.bankAccountType.fields.account_type') }}</label>
                <input class="form-control {{ $errors->has('account_type') ? 'is-invalid' : '' }}" type="text" name="account_type" id="account_type" value="{{ old('account_type', $bankAccountType->account_type) }}">
                @if($errors->has('account_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bankAccountType.fields.account_type_helper') }}</span>
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