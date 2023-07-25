@extends('layouts.admin')
@section('content')
@can('spouse_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.spouse-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.spouseDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.spouseDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SpouseDetail">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        {{-- <th>
                            {{ trans('cruds.spouseDetail.fields.id') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.spouseDetail.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.last_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.first_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.maiden_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.relationship') }}
                        </th>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.date_of_birth') }}
                        </th>
                        <th>
                            {{ trans('cruds.spouseDetail.fields.wedding_anniv') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spouseDetails as $key => $spouseDetail)
                        <tr data-entry-id="{{ $spouseDetail->id }}">
                            <td>

                            </td>
                            {{-- <td>
                                {{ $spouseDetail->id ?? '' }}
                            </td> --}}
                            <td>
                                {{ App\Models\SpouseDetail::TITLE_SELECT[$spouseDetail->title] ?? '' }}
                            </td>
                            <td>
                                {{ $spouseDetail->last_name ?? '' }}
                            </td>
                            <td>
                                {{ $spouseDetail->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $spouseDetail->maiden_name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SpouseDetail::RELATIONSHIP_SELECT[$spouseDetail->relationship] ?? '' }}
                            </td>
                            <td>
                                {{ $spouseDetail->date_of_birth ?? '' }}
                            </td>
                            <td>
                                {{ $spouseDetail->wedding_anniv ?? '' }}
                            </td>
                            <td>
                                @can('spouse_detail_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.spouse-details.show', $spouseDetail->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('spouse_detail_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.spouse-details.edit', $spouseDetail->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('spouse_detail_delete')
                                    <form action="{{ route('admin.spouse-details.destroy', $spouseDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('spouse_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.spouse-details.massDestroy') }}",
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
    order: [[ 3, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-SpouseDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection