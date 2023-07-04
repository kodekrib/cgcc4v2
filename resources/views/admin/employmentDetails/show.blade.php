@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employmentDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employment-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $employmentDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.employer_name') }}
                        </th>
                        <td>
                            {{ $employmentDetail->employer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.employer_address') }}
                        </th>
                        <td>
                            {{ $employmentDetail->employer_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.employer_address_2') }}
                        </th>
                        <td>
                            {{ $employmentDetail->employer_address_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.country') }}
                        </th>
                        <td>
                            {{ $employmentDetail->country?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.state') }}
                        </th>
                        <td>
                            {{ $employmentDetail->state ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.city') }}
                        </th>
                        <td>
                            {{ $employmentDetail->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.position_held') }}
                        </th>
                        <td>
                            {{ $employmentDetail->position_held }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.industry') }}
                        </th>
                        <td>
                            {{ $employmentDetail->industry->industry ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.subsector') }}
                        </th>
                        <td>
                            {{ $employmentDetail->subsector->name ?? 'N/A' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employment-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
