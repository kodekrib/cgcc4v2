@extends('layouts.admin')
@section('content')
@can('employment_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employment-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employmentDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employmentDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-EmploymentDetail">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.employer_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.employer_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.employer_address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.position_held') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.industry') }}
                        </th>
                        <th>
                            {{ trans('cruds.employmentDetail.fields.subsector') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employmentDetails as $key => $employmentDetail)
                        <tr data-entry-id="{{ $employmentDetail->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $employmentDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $employmentDetail->employer_name ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->employer_address ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->employer_address_2 ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->country ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->state ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->city ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->position_held ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->industry->industry ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $employmentDetail->subsector->name ?? 'N/A' }}
                            </td>
                            <td>
                                @can('employment_detail_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.employment-details.show', $employmentDetail->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('employment_detail_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.employment-details.edit', $employmentDetail->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('employment_detail_delete')
                                    <form action="{{ route('admin.employment-details.destroy', $employmentDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('employment_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employment-details.massDestroy') }}",
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
  let table = $('.datatable-EmploymentDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
