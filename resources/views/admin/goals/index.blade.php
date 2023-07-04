@extends('layouts.admin')
@section('content')
@can('goal_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.goals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.goal.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.goal.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Goal">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.goal_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.achievement_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.goal_kpi') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.open') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.in_progress') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.not_archieved') }}
                    </th>
                    <th>
                        {{ trans('cruds.goal.fields.closed') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('goal_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.goals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.goals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'date', name: 'date' },
{ data: 'goal_name', name: 'goal_name' },
{ data: 'achievement_date', name: 'achievement_date' },
{ data: 'goal_kpi', name: 'goal_kpi' },
{ data: 'open', name: 'open' },
{ data: 'in_progress', name: 'in_progress' },
{ data: 'not_archieved', name: 'not_archieved' },
{ data: 'closed', name: 'closed' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Goal').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection