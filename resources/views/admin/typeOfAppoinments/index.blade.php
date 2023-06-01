@extends('layouts.admin')
@section('content')
@can('type_of_appoinment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.type-of-appoinments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.typeOfAppoinment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.typeOfAppoinment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TypeOfAppoinment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.typeOfAppoinment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.typeOfAppoinment.fields.type') }}
                        </th>
                        <th>
                            Default Member
                        </th>
                        <th>
                            Default Member Email
                        </th>
                        <th>
                            Member Managing Type
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($typeOfAppoinments as $key => $typeOfAppoinment)
                        <tr data-entry-id="{{ $typeOfAppoinment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $typeOfAppoinment->id ?? '' }}
                            </td>
                            <td>
                                {{ $typeOfAppoinment->type ?? '' }}
                            </td>
                            <td>
                                {{ $typeOfAppoinment->default_members->member_name }}
                            </td>
                            <td>
                                {{ $typeOfAppoinment->default_members->email }}
                            </td>
                            <td>
                                @foreach($typeOfAppoinment->memberManageAppointmentType as $label => $item)
                                    <span class="badge badge-info">{{ $item->member_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('type_of_appoinment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.type-of-appoinments.show', $typeOfAppoinment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('type_of_appoinment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.type-of-appoinments.edit', $typeOfAppoinment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('type_of_appoinment_delete')
                                    <form action="{{ route('admin.type-of-appoinments.destroy', $typeOfAppoinment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('type_of_appoinment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.type-of-appoinments.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-TypeOfAppoinment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
