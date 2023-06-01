@extends('layouts.admin')
@section('content')
@can('ats_membership_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ats-memberships.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.atsMembership.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.atsMembership.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AtsMembership">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.atsMembership.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.atsMembership.fields.ats_membership_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.ats_membership_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.year') }}
                        </th>
                        <th>
                            {{ trans('cruds.atsMembershipRecord.fields.month') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($atsMemberships as $key => $atsMembership)
                        <tr data-entry-id="{{ $atsMembership->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $atsMembership->id ?? '' }}
                            </td>
                            <td>
                                {{ $atsMembership->ats_membership_number->names ?? '' }}
                            </td>
                            <td>
                                {{ $atsMembership->ats_membership_number->ats_membership_no ?? '' }}
                            </td>
                            <td>
                                {{ $atsMembership->ats_membership_number->year ?? '' }}
                            </td>
                            <td>
                                {{ $atsMembership->ats_membership_number->month ?? '' }}
                            </td>
                            <td>
                                @can('ats_membership_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ats-memberships.show', $atsMembership->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ats_membership_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ats-memberships.edit', $atsMembership->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ats_membership_delete')
                                    <form action="{{ route('admin.ats-memberships.destroy', $atsMembership->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('ats_membership_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ats-memberships.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-AtsMembership:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection