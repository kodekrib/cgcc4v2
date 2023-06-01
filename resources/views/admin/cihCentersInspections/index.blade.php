@extends('layouts.admin')
@section('content')
@can('cih_centers_inspection_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cih-centers-inspections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cihCentersInspection.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cihCentersInspection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CihCentersInspection">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.date_of_inspection') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentersInspection.fields.center_visited') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cihCentersInspections as $key => $cihCentersInspection)
                        <tr data-entry-id="{{ $cihCentersInspection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cihCentersInspection->id ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentersInspection->date_of_inspection ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentersInspection->center_visited->cih_centre ?? '' }}
                            </td>
                            <td>
                                @can('cih_centers_inspection_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cih-centers-inspections.show', $cihCentersInspection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cih_centers_inspection_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cih-centers-inspections.edit', $cihCentersInspection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cih_centers_inspection_delete')
                                    <form action="{{ route('admin.cih-centers-inspections.destroy', $cihCentersInspection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cih_centers_inspection_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cih-centers-inspections.massDestroy') }}",
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
  let table = $('.datatable-CihCentersInspection:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection