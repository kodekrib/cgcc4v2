@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.meeting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.id') }}
                        </th>
                        <td>
                            {{ $meeting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_type') }}
                        </th>
                        <td>
                            {{ $meeting->meeting_type->types ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.date_of_meeting') }}
                        </th>
                        <td>
                            {{ $meeting->date_of_meeting }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.time_duration') }}
                        </th>
                        <td>
                            {{ $meeting->time_duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_title') }}
                        </th>
                        <td>
                            {{ $meeting->meeting_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.venue') }}
                        </th>
                        <td>
                            {{ $meeting->venue->venue_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.attendees') }}
                        </th>
                        <td>
                            {{ $meeting->attendees->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_minutes') }}
                        </th>
                        <td>
                            @foreach($meeting->meeting_minutes as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.files') }}
                        </th>
                        <td>
                            @foreach($meeting->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.processing') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $meeting->processing ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $meeting->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.meeting.fields.disapproved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $meeting->disapproved ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.meetings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection