@extends('layouts.admin')
@section('content')
@can('cih_request_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cih-requests.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cihRequest.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cihRequest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CihRequest">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.date_of_request') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.requester_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.middlename') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.types_of_request') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.date_of_request_event') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.approve') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.decline') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihRequest.fields.pending') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cihRequests as $key => $cihRequest)
                        <tr data-entry-id="{{ $cihRequest->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cihRequest->id ?? '' }}
                            </td>
                            <td>
                                {{ $cihRequest->date_of_request ?? '' }}
                            </td>
                            <td>
                                {{ $cihRequest->requester_name->member_name ?? '' }}
                            </td>
                            <td>
                                {{ $cihRequest->requester_name->middlename ?? '' }}
                            </td>
                            <td>
                                {{ $cihRequest->types_of_request->types_of_request ?? '' }}
                            </td>
                            <td>
                                {{ $cihRequest->date_of_request_event ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $cihRequest->approve ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $cihRequest->approve ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $cihRequest->decline ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $cihRequest->decline ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $cihRequest->pending ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $cihRequest->pending ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('cih_request_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cih-requests.show', $cihRequest->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cih_request_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cih-requests.edit', $cihRequest->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cih_request_delete')
                                    <form action="{{ route('admin.cih-requests.destroy', $cihRequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cih_request_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cih-requests.massDestroy') }}",
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
  let table = $('.datatable-CihRequest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection