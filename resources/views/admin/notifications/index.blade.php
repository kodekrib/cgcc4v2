@extends('layouts.admin')
@section('content')
@can('notification_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.notifications.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.notification.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.notification.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Notification">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.notification.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.notification.fields.message_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.notification.fields.phone_number') }}
                    </th>
                    <!-- <th>
                        {{ trans('cruds.user.fields.mobile') }}
                    </th> -->
                    <th>
                        {{ trans('cruds.notification.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.notification.fields.date') }}
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
@can('notification_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.notifications.massDestroy') }}",
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
    ajax: "{{ route('admin.notifications.index') }}",
    aoColumns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'message_title', name: 'message_title' },
        {  "mData": "phone_number_name",
            "mRender": (row, type, val, mata) => {
                if(val.phone_number_name !== undefined && val.phone_number_name !== null){
                  // console.log(val);
                    return `${val.phone_number_name} - (${val.phone_number.mobile})`;
                } else {
                    return 'N/A';
                }
            }
        },
        //{ data: 'phone_number_name', name: 'phone_number.name' },
        //{ data: 'phone_number.mobile', name: 'phone_number.mobile' },
        { data: 'email', name: 'emails.email' },
        { data: 'date', name: 'date' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        };
        let table = $('.datatable-Notification').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

});

</script>
@endsection
