@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <td>
                            {{ $event->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.description') }}
                        </th>
                        <td>
                            {!! $event->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.start_date') }}
                        </th>
                        <td>
                            {{ $event->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.start_time') }}
                        </th>
                        <td>
                            {{ $event->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.end_time') }}
                        </th>
                        <td>
                            {{ $event->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.duration') }}
                        </th>
                        <td>
                            {{ $event->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.expected_amount') }}
                        </th>
                        <td>
                            {{ $event->expected_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.no_of_days') }}
                        </th>
                        <td>
                            {{ $event->no_of_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.accredited') }}
                        </th>
                        <td>
                            {{ $event->accredited }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.attendees') }}
                        </th>
                        <td>
                            {{ $event->attendees->attendees ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.allow_overflow') }}
                        </th>
                        <td>
                            {{ App\Models\Event::ALLOW_OVERFLOW_SELECT[$event->allow_overflow] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.status') }}
                        </th>
                        <td>
                                @if($event->status == 0)
                                    <a class="btn btn-xs btn-warning" style="color: white;">
                                        Inactive
                                    </a>
                                @endif
                                @if($event->status == 1)
                                    <a class="btn btn-xs btn-success" style="color: white;">
                                       Active
                                    </a>
                                @endif
                                @if($event->status == 2)
                                    <a class="btn btn-xs btn-danger" style="color: white;">
                                    Cancelled
                                    </a>
                                @endif
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>
                            {{ trans('cruds.event.fields.inactive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $event->inactive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.cancelled') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $event->cancelled ? 'checked' : '' }}>
                        </td>
                    </tr> -->
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.created_by') }}
                        </th>
                        <td>
                            {{ $event->created_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#event_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.booking.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="event_bookings">
            @includeIf('admin.events.relationships.eventBookings', ['bookings' => $event->eventBookings])
        </div>
    </div>
</div>

@endsection
