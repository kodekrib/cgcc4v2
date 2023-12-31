@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reminder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reminders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.id') }}
                        </th>
                        <td>
                            {{ $reminder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.subject') }}
                        </th>
                        <td>
                            {{ $reminder->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.description') }}
                        </th>
                        <td>
                            {!! $reminder->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.reminder_date') }}
                        </th>
                        <td>
                            {{ $reminder->reminder_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reminders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection