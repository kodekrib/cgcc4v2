@extends('layouts.admin')
@section('content')
@can('cihzone_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cihzones.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cihzone.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Cihzone', 'route' => 'admin.cihzones.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cihzone.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Cihzone">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.zone_area') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.coordinator') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.inactive') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.cancelled') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cihzones as $key => $cihzone)
                        <tr data-entry-id="{{ $cihzone->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cihzone->id ?? '' }}
                            </td>
                            <td>
                                {{ $cihzone->zone ?? '' }}
                            </td>
                            <td>
                                {{ $cihzone->zone_area ?? '' }}
                            </td>
                            <td>
                                {{ $cihzone->coordinator->member_name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $cihzone->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $cihzone->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $cihzone->inactive ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $cihzone->inactive ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $cihzone->cancelled ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $cihzone->cancelled ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('cihzone_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cihzones.show', $cihzone->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cihzone_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cihzones.edit', $cihzone->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cihzone_delete')
                                    <form action="{{ route('admin.cihzones.destroy', $cihzone->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cihzone_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cihzones.massDestroy') }}",
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
  let table = $('.datatable-Cihzone:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection