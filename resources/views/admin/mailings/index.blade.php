@extends('layouts.admin')
@section('content')
@can('mailing_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mailings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mailing.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mailing.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Mailing">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.mailing.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.mailing.fields.job_mailing_list') }}
                    </th>
                    <th>
                        {{ trans('cruds.mailing.fields.area_of_specialization') }}
                    </th>
                    <th>
                        {{ trans('cruds.mailing.fields.job_level') }}
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
@can('mailing_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mailings.massDestroy') }}",
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
    ajax: "{{ route('admin.mailings.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'job_mailing_list', name: 'job_mailing_list' },
        {  "mData": "area_of_specialization_area_of_specialization",
            "mRender": (row, type, val, mata) => {
                if(val.area_of_specialization !== undefined && val.area_of_specialization !== null){
                  // console.log(val);
                    return val.area_of_specialization.area_of_specialization;
                } else {
                    return 'N/A';
                }
            }
        },
        {  "mData": "job_level_job_level",
            "mRender": (row, type, val, mata) => {
                if(val.job_level !== undefined && val.job_level !== null){
                  // console.log(val);
                    return val.job_level.job_level;
                } else {
                    return 'N/A';
                }
            }
        },
        //{ data: 'area_of_specialization_area_of_specialization', name: 'area_of_specialization.area_of_specialization' },
        //{ data: 'job_level_job_level', name: 'job_level.job_level' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Mailing').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
