@can('members_affinity_group_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.members-affinity-groups.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.membersAffinityGroup.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.membersAffinityGroup.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-createdByMembersAffinityGroups">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.membersAffinityGroup.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.membersAffinityGroup.fields.member_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.membersAffinityGroup.fields.affinity_group') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($membersAffinityGroups as $key => $membersAffinityGroup)
                        <tr data-entry-id="{{ $membersAffinityGroup->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $membersAffinityGroup->id ?? '' }}
                            </td>
                            <td>
                                {{ $membersAffinityGroup->member_name ?? '' }}
                            </td>
                            <td>
                                {{ $membersAffinityGroup->affinity_group ?? '' }}
                            </td>
                            <td>
                                @can('members_affinity_group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.members-affinity-groups.show', $membersAffinityGroup->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('members_affinity_group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.members-affinity-groups.edit', $membersAffinityGroup->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('members_affinity_group_delete')
                                    <form action="{{ route('admin.members-affinity-groups.destroy', $membersAffinityGroup->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('members_affinity_group_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.members-affinity-groups.massDestroy') }}",
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
    order: [[ 3, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-createdByMembersAffinityGroups:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection