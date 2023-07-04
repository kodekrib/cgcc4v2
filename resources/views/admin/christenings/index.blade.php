@extends('layouts.admin')
@section('content')
@can('christening_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.christenings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.christening.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.christening.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Christening">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.parent') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.no_at_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.ceremony_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.cihzone.fields.zone_area') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.ceremony_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.approved') }}
                        </th>
                        <th>
                            {{ trans('cruds.christening.fields.pending') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($christenings as $key => $christening)
                        <tr data-entry-id="{{ $christening->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $christening->id ?? '' }}
                            </td>
                            <td>
                                {{ $christening->parent ?? '' }}
                            </td>
                            <td>
                                {{ $christening->no_at_birth ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Christening::GENDER_SELECT[$christening->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $christening->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $christening->ceremony_location ?? '' }}
                            </td>
                            <td>
                                {{ $christening->zone->zone ?? '' }}
                            </td>
                            <td>
                                {{ $christening->zone->zone_area ?? '' }}
                            </td>
                            <td>
                                {{ $christening->ceremony_time ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $christening->approved ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $christening->approved ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $christening->pending ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $christening->pending ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('christening_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.christenings.show', $christening->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('christening_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.christenings.edit', $christening->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('christening_delete')
                                    <form action="{{ route('admin.christenings.destroy', $christening->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('christening_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.christenings.massDestroy') }}",
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
  let table = $('.datatable-Christening:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection