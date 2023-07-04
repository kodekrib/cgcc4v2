@can('join_department_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.join-departments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.joinDepartment.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.joinDepartment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-departmentJoinDepartments">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.department.fields.department_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.member_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.primary_function') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.is_approved') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.is_pending') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.disapproved') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.delisted') }}
                        </th>
                        <th>
                            {{ trans('cruds.joinDepartment.fields.reason') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($joinDepartments as $key => $joinDepartment)
                        <tr data-entry-id="{{ $joinDepartment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $joinDepartment->id ?? '' }}
                            </td>
                            <td>
                                {{ $joinDepartment->department->department_name ?? '' }}
                            </td>
                            <td>
                                {{ $joinDepartment->department->department_email ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\JoinDepartment::MEMBER_TYPE_SELECT[$joinDepartment->member_type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\JoinDepartment::PRIMARY_FUNCTION_SELECT[$joinDepartment->primary_function] ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $joinDepartment->is_approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $joinDepartment->is_approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $joinDepartment->is_pending ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $joinDepartment->is_pending ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $joinDepartment->disapproved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $joinDepartment->disapproved ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $joinDepartment->delisted ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $joinDepartment->delisted ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $joinDepartment->reason ?? '' }}
                            </td>
                            <td>
                                @can('join_department_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.join-departments.show', $joinDepartment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('join_department_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.join-departments.edit', $joinDepartment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('join_department_delete')
                                    <form action="{{ route('admin.join-departments.destroy', $joinDepartment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('join_department_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.join-departments.massDestroy') }}",
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
  let table = $('.datatable-departmentJoinDepartments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection