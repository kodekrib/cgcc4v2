@extends('layouts.admin')
@section('content')
@can('inspectorate_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.inspectorate-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.inspectorateGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.inspectorateGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-InspectorateGroup">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.inspectorateGroup.fields.group') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inspectorateGroups as $key => $inspectorateGroup)
                        <tr data-entry-id="{{ $inspectorateGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $inspectorateGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $inspectorateGroup->surname ?? '' }}
                            </td>
                            <td>
                                {{ $inspectorateGroup->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $inspectorateGroup->group->title ?? '' }}
                            </td>
                            <td>
                                @can('inspectorate_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.inspectorate-groups.show', $inspectorateGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('inspectorate_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.inspectorate-groups.edit', $inspectorateGroup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('inspectorate_group_delete')
                                    <form action="{{ route('admin.inspectorate-groups.destroy', $inspectorateGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('inspectorate_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.inspectorate-groups.massDestroy') }}",
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
  let table = $('.datatable-InspectorateGroup:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection