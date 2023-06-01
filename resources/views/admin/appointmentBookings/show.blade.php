@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointmentBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointment-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $appointmentBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.member_name') }}
                        </th>
                        <td>
                            {{ $appointmentBooking->member_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.appointment_type') }}
                        </th>
                        <td>
                            {{ $appointmentBooking->appointment_type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.appointment_date') }}
                        </th>
                        <td>
                            {{ $appointmentBooking->appointment_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.appointment_time') }}
                        </th>
                        <td>
                            {{ $appointmentBooking->appointment_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.purpose') }}
                        </th>
                        <td>
                            {!! $appointmentBooking->purpose !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.assigned_to') }}
                        </th>
                        <td>
                            {{ $appointmentBooking->assigned_to->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointmentBooking->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.disapproved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointmentBooking->disapproved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.opened') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointmentBooking->opened ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.re_assigned') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointmentBooking->re_assigned ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointmentBooking.fields.in_progress') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $appointmentBooking->in_progress ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointment-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection