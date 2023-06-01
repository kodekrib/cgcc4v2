@can('cih_centre_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cih-centres.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cihCentre.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.cihCentre.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-cityCihCentres">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.cih_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.nearest_bus_stop') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.cih_host_hostess') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.cih_pastor') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.prayer_secretary') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihCentre.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cihCentres as $key => $cihCentre)
                        <tr data-entry-id="{{ $cihCentre->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cihCentre->id ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_address ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->nearest_bus_stop ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_host_hostess->email ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_host_hostess->name ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_host_hostess->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_pastor->email ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_pastor->name ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->cih_pastor->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->prayer_secretary->email ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->prayer_secretary->name ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->prayer_secretary->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->country->name ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->state->name ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->city->name ?? '' }}
                            </td>
                            <td>
                                {{ $cihCentre->zone->zone ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CihCentre::STATUS_SELECT[$cihCentre->status] ?? '' }}
                            </td>
                            <td>
                                @can('cih_centre_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cih-centres.show', $cihCentre->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cih_centre_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cih-centres.edit', $cihCentre->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cih_centre_delete')
                                    <form action="{{ route('admin.cih-centres.destroy', $cihCentre->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cih_centre_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cih-centres.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-cityCihCentres:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection