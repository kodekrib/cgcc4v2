@extends('layouts.admin')
@section('content')
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.events.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.start_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.end_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.expected_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.no_of_days') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.accredited') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.attendees') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.allow_overflow') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.status') }}
                        </th>
                        <!-- <th>
                            {{ trans('cruds.event.fields.inactive') }}
                        </th>
                        <th>
                            {{ trans('cruds.event.fields.cancelled') }}
                        </th> -->
                        <th>
                            {{ trans('cruds.event.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        <tr data-entry-id="{{ $event->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $event->id ?? '' }}
                            </td>
                            <td>
                                {{ $event->name ?? '' }}
                            </td>
                            <td>
                                {{ $event->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $event->start_time ?? '' }}
                            </td>
                            <td>
                                {{ $event->end_time ?? '' }}
                            </td>
                            <td>
                                {{ $event->duration ?? '' }}
                            </td>
                            <td>
                                {{ $event->expected_amount ?? '' }}
                            </td>
                            <td>
                                {{ $event->no_of_days ?? '' }}
                            </td>
                            <td>
                                {{ $event->accredited ?? '' }}
                            </td>
                            <td>
                                {{ $event->attendees->attendees ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Event::ALLOW_OVERFLOW_SELECT[$event->allow_overflow] ?? '' }}
                            </td>
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
                            <!-- <td>
                                <span style="display:none">{{ $event->inactive ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $event->inactive ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $event->cancelled ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $event->cancelled ? 'checked' : '' }}>
                            </td> -->
                            <td>
                                {{ $event->created_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $event->created_by->firstname ?? '' }}
                            </td>
                            <td>
                                @can('event_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('event_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.events.edit', $event->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('event_delete')
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.events.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
