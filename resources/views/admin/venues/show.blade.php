@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.venue.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venues.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.id') }}
                        </th>
                        <td>
                            {{ $venue->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.venue_name') }}
                        </th>
                        <td>
                            {{ $venue->venue_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.venue_description') }}
                        </th>
                        <td>
                            {{ $venue->venue_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.accessories_equipment') }}
                        </th>
                        <td>
                            @foreach($venue->accessories_equipments as $key => $accessories_equipment)
                                <span class="label label-info">{{ $accessories_equipment->accessories }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.accessibility_features') }}
                        </th>
                        <td>
                            @foreach($venue->accessibility_features as $key => $accessibility_features)
                                <span class="label label-info">{{ $accessibility_features->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.venue_capacity') }}
                        </th>
                        <td>
                            {{ $venue->venue_capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.size') }}
                        </th>
                        <td>
                            {{ $venue->size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.venue_location') }}
                        </th>
                        <td>
                            {{ $venue->venue_location->location ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.venue.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Venue::STATUS_SELECT[$venue->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.venues.index') }}">
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
            <a class="nav-link" href="#venue_bookings" role="tab" data-toggle="tab">
                {{ trans('cruds.booking.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="venue_bookings">
            @includeIf('admin.venues.relationships.venueBookings', ['bookings' => $venue->venueBookings])
        </div>
    </div>
</div>

@endsection