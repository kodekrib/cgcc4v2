@extends('layouts.admin')
@section('content')
@can('venue_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.venues.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.venue.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.venue.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Venue">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.venue_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.venue_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.accessories_equipment') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.accessibility_features') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.venue_capacity') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.size') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.venue_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venues as $key => $venue)
                        <tr data-entry-id="{{ $venue->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $venue->id ?? '' }}
                            </td>
                            <td>
                                {{ $venue->venue_name ?? '' }}
                            </td>
                            <td>
                                {{ $venue->venue_description ?? '' }}
                            </td>
                            <td>
                                @foreach($venue->accessories_equipments as $key => $item)
                                    <span class="badge badge-info">{{ $item->accessories }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($venue->accessibility_features as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $venue->venue_capacity ?? '' }}
                            </td>
                            <td>
                                {{ $venue->size ?? '' }}
                            </td>
                            <td>
                                {{ $venue->venue_location->location ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Venue::STATUS_SELECT[$venue->status] ?? '' }}
                            </td>
                            <td>
                                @can('venue_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.venues.show', $venue->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('venue_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.venues.edit', $venue->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('venue_delete')
                                    <form action="{{ route('admin.venues.destroy', $venue->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('venue_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.venues.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-Venue:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection