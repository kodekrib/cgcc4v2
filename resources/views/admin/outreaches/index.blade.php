@extends('layouts.admin')
@section('content')
@can('outreach_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.outreaches.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.outreach.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.outreach.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Outreach">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.contact_person') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.outreach.fields.completed') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outreaches as $key => $outreach)
                        <tr data-entry-id="{{ $outreach->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $outreach->id ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->type->type ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->name ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->description ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->date ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->time ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->location->location ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->contact_person->email ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->contact_person->name ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->contact_person->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $outreach->contact_person->mobile ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $outreach->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $outreach->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $outreach->completed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $outreach->completed ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('outreach_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.outreaches.show', $outreach->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('outreach_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.outreaches.edit', $outreach->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('outreach_delete')
                                    <form action="{{ route('admin.outreaches.destroy', $outreach->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('outreach_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.outreaches.massDestroy') }}",
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
  let table = $('.datatable-Outreach:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection