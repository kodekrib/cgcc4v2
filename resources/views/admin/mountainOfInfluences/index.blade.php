@extends('layouts.admin')
@section('content')
@can('mountain_of_influence_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mountain-of-influences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mountainOfInfluence.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mountainOfInfluence.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MountainOfInfluence">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mountainOfInfluence.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.mountainOfInfluence.fields.my_mountain_of_culture') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mountainOfInfluences as $key => $mountainOfInfluence)
                        <tr data-entry-id="{{ $mountainOfInfluence->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mountainOfInfluence->id ?? '' }}
                            </td>
                            <td>
                                {{ $mountainOfInfluence->my_mountain_of_culture->corresponding_mountain ?? '' }}
                            </td>
                            <td>
                                @can('mountain_of_influence_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.mountain-of-influences.show', $mountainOfInfluence->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('mountain_of_influence_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.mountain-of-influences.edit', $mountainOfInfluence->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('mountain_of_influence_delete')
                                    <form action="{{ route('admin.mountain-of-influences.destroy', $mountainOfInfluence->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('mountain_of_influence_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mountain-of-influences.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-MountainOfInfluence:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection