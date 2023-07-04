@extends('layouts.admin')
@section('content')
@can('issue_management_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.issue-managements.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.issueManagement.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.issueManagement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-IssueManagement">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.issue_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.issue_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.issue_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.department_concerned') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.open') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.work_in_progress') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.closed') }}
                        </th>
                        <th>
                            {{ trans('cruds.issueManagement.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.firstname') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.mobile') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($issueManagements as $key => $issueManagement)
                        <tr data-entry-id="{{ $issueManagement->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $issueManagement->id ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->date ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->issue_title ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->issue_description ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->issue_location->name ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->department_concerned->department_name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $issueManagement->open ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $issueManagement->open ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $issueManagement->work_in_progress ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $issueManagement->work_in_progress ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $issueManagement->closed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $issueManagement->closed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $issueManagement->created_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->created_by->email ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->created_by->firstname ?? '' }}
                            </td>
                            <td>
                                {{ $issueManagement->created_by->mobile ?? '' }}
                            </td>
                            <td>
                                @can('issue_management_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.issue-managements.show', $issueManagement->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('issue_management_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.issue-managements.edit', $issueManagement->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('issue_management_delete')
                                    <form action="{{ route('admin.issue-managements.destroy', $issueManagement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('issue_management_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.issue-managements.massDestroy') }}",
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
  let table = $('.datatable-IssueManagement:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection