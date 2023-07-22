@extends('layouts.admin')
@section('content')
@can('interest_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.interests.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.interest.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.interest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Interest">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        {{-- <th>
                            {{ trans('cruds.interest.fields.id') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.interest.fields.interests') }}
                        </th>
                        <th>
                            {{ trans('cruds.interest.fields.other_sports') }}
                        </th>
                        <th>
                            {{ trans('cruds.interest.fields.social_causes') }}
                        </th>
                        <th>
                            {{ trans('cruds.interest.fields.entrepreneurial_interests') }}
                        </th>
                        <th>
                            {{ trans('cruds.interest.fields.industry_sector') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($interests as $key => $interest)
                        <tr data-entry-id="{{ $interest->id }}">
                            <td>

                            </td>
                            {{-- <td>
                                {{ $interest->id ?? '' }}
                            </td> --}}
                            <td>
                                @foreach($interest->interests as $key => $item)
                                    <span class="badge badge-info">{{ $item->sports }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $interest->other_sports ?? '' }}
                            </td>
                            <td>
                                {{ $interest->social_causes ?? '' }}
                            </td>
                            <td>
                                {{ $interest->entrepreneurial_interests ?? '' }}
                            </td>
                            <td>
                                {{ $interest->industry_sector->industry ?? '' }}
                            </td>
                            <td>
                                @can('interest_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.interests.show', $interest->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('interest_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.interests.edit', $interest->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('interest_delete')
                                    <form action="{{ route('admin.interests.destroy', $interest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('interest_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.interests.massDestroy') }}",
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
  let table = $('.datatable-Interest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection