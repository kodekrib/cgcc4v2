@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.firstTimer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.first-timers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.id') }}
                        </th>
                        <td>
                            {{ $firstTimer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.service') }}
                        </th>
                        <td>
                            {{ $firstTimer->service }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.surname') }}
                        </th>
                        <td>
                            {{ $firstTimer->surname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.first_name') }}
                        </th>
                        <td>
                            {{ $firstTimer->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $firstTimer->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $firstTimer->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.marital_status') }}
                        </th>
                        <td>
                            {{ $firstTimer->marital_status->marital_status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.occupation') }}
                        </th>
                        <td>
                            {{ $firstTimer->occupation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::GENDER_SELECT[$firstTimer->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.age') }}
                        </th>
                        <td>
                            {{ $firstTimer->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $firstTimer->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.email') }}
                        </th>
                        <td>
                            {{ $firstTimer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.residential_address') }}
                        </th>
                        <td>
                            {{ $firstTimer->residential_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.nearest_bus_stop') }}
                        </th>
                        <td>
                            {{ $firstTimer->nearest_bus_stop }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.country') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::COUNTRY_SELECT[$firstTimer->country] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.state') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::STATE_SELECT[$firstTimer->state] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.city') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::CITY_SELECT[$firstTimer->city] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.join_cgcc') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::JOIN_CGCC_SELECT[$firstTimer->join_cgcc] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.start_ats') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::START_ATS_SELECT[$firstTimer->start_ats] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.ats_mode') }}
                        </th>
                        <td>
                            {{ App\Models\FirstTimer::ATS_MODE_SELECT[$firstTimer->ats_mode] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.firstTimer.fields.prayer_request') }}
                        </th>
                        <td>
                            {{ $firstTimer->prayer_request }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.first-timers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection