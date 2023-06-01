@extends('layouts.admin')
@section('content')
@can('centre_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.centres.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.centre.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.centre.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Centre">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.centre.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.centre.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.middlename') }}
                        </th>
                        <th>
                            {{ trans('cruds.centre.fields.cih_centre') }}
                        </th>
                        <th>
                            {{ trans('cruds.centre.fields.role') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centres as $key => $centre)
                        <tr data-entry-id="{{ $centre->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $centre->id ?? '' }}
                            </td>
                            <td>
                                {{ $centre->name->member_name ?? '' }}
                            </td>
                            <td>
                                {{ $centre->name->middlename ?? '' }}
                            </td>
                            <td>
                                {{ $centre->cih_centre ?? '' }}
                            </td>
                            <td>
                                {{ $centre->role->title ?? '' }}
                            </td>
                            <td>
                                @can('centre_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.centres.show', $centre->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('centre_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.centres.edit', $centre->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('centre_delete')
                                    <form action="{{ route('admin.centres.destroy', $centre->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('centre_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.centres.massDestroy') }}",
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
  let table = $('.datatable-Centre:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection