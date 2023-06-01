@can('church_in_the_house_center_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.church-in-the-house-centers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.churchInTheHouseCenter.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.churchInTheHouseCenter.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-churchInTheHouseChurchInTheHouseCenters">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.churchInTheHouseCenter.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.churchInTheHouseCenter.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.churchInTheHouseCenter.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.churchInTheHouseCenter.fields.church_in_the_house') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($churchInTheHouseCenters as $key => $churchInTheHouseCenter)
                        <tr data-entry-id="{{ $churchInTheHouseCenter->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->id ?? '' }}
                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->created_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->created_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->created_by->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->created_by->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->zone->zone ?? '' }}
                            </td>
                            <td>
                                {{ $churchInTheHouseCenter->church_in_the_house->cih_address ?? '' }}
                            </td>
                            <td>
                                @can('church_in_the_house_center_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.church-in-the-house-centers.show', $churchInTheHouseCenter->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('church_in_the_house_center_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.church-in-the-house-centers.edit', $churchInTheHouseCenter->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('church_in_the_house_center_delete')
                                    <form action="{{ route('admin.church-in-the-house-centers.destroy', $churchInTheHouseCenter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('church_in_the_house_center_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.church-in-the-house-centers.massDestroy') }}",
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
    order: [[ 6, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-churchInTheHouseChurchInTheHouseCenters:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection