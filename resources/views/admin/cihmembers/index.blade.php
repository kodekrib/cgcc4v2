@extends('layouts.admin')
@section('content')
@can('cihmember_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cihmembers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cihmember.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Cihmember', 'route' => 'admin.cihmembers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cihmember.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Cihmember">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.member_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihmember.fields.cih') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cihmembers as $key => $cihmember)
                        <tr data-entry-id="{{ $cihmember->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cihmember->id ?? '' }}
                            </td>
                            <td>
                                {{ $cihmember->created_by->member_name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Cihmember::GENDER_SELECT[$cihmember->created_by->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $cihmember->created_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $cihmember->created_by->mobile ?? '' }}
                            </td>
                            <td>
                                {{ $cihmember->zone->zone ?? '' }}
                            </td>
                            <td>
                                {{ $cihmember->cih->cih_centre ?? '' }}
                            </td>
                            <td>
                                @can('cihmember_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cihmembers.show', $cihmember->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cihmember_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cihmembers.edit', $cihmember->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cihmember_delete')
                                    <form action="{{ route('admin.cihmembers.destroy', $cihmember->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cihmember_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cihmembers.massDestroy') }}",
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
  let table = $('.datatable-Cihmember:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
