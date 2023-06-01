@extends('layouts.admin')
@section('content')
@can('dedication_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.dedications.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dedication.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dedication.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Dedication">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.parent') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.no_at_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.date_of_dedication') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.approved') }}
                        </th>
                        <th>
                            {{ trans('cruds.dedication.fields.pending') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dedications as $key => $dedication)
                        <tr data-entry-id="{{ $dedication->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dedication->id ?? '' }}
                            </td>
                            <td>
                                {{ $dedication->parent ?? '' }}
                            </td>
                            <td>
                                {{ $dedication->no_at_birth ?? '' }}
                            </td>
                            <td>
                                {{ $dedication->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $dedication->date_of_dedication ?? '' }}
                            </td>
                            <td>
                                {{ $dedication->department ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $dedication->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $dedication->approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $dedication->pending ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $dedication->pending ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('dedication_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.dedications.show', $dedication->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dedication_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.dedications.edit', $dedication->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dedication_delete')
                                    <form action="{{ route('admin.dedications.destroy', $dedication->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('dedication_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.dedications.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-Dedication:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection