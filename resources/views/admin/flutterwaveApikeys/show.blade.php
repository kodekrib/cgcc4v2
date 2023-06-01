@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.flutterwaveApikey.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.flutterwave-apikeys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.flutterwaveApikey.fields.id') }}
                        </th>
                        <td>
                            {{ $flutterwaveApikey->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.flutterwaveApikey.fields.public_key') }}
                        </th>
                        <td>
                            {{ $flutterwaveApikey->public_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.flutterwaveApikey.fields.secret_key') }}
                        </th>
                        <td>
                            {{ $flutterwaveApikey->secret_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.flutterwaveApikey.fields.encryption_key') }}
                        </th>
                        <td>
                            {{ $flutterwaveApikey->encryption_key }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.flutterwave-apikeys.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection