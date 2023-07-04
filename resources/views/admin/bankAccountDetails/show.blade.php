@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bankAccountDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bank-account-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccountDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $bankAccountDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccountDetail.fields.account_name') }}
                        </th>
                        <td>
                            {{ $bankAccountDetail->account_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccountDetail.fields.account_type') }}
                        </th>
                        <td>
                            {{ $bankAccountDetail->account_type->account_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccountDetail.fields.currency') }}
                        </th>
                        <td>
                            {{ $bankAccountDetail->currency->currency ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccountDetail.fields.account_number') }}
                        </th>
                        <td>
                            {{ $bankAccountDetail->account_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bankAccountDetail.fields.sort_code') }}
                        </th>
                        <td>
                            {{ $bankAccountDetail->sort_code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bank-account-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection