@can('attendance_management_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.attendance-managements.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.attendanceManagement.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.attendanceManagement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-membersInAttendanceAttendanceManagements">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.meeting_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.meeting_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.meeting.fields.meeting_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.summary_report') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.external_files') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.members_in_attendance') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.age_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.gender_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.state_of_the_flock') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.cih_centre') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.present') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.absent') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.excused') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceManagements as $key => $attendanceManagement)
                        <tr data-entry-id="{{ $attendanceManagement->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $attendanceManagement->id ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->meeting_type->types ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->meeting_title->meeting_title ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->meeting_title->meeting_title ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->date ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->summary_report ?? '' }}
                            </td>
                            <td>
                                @foreach($attendanceManagement->external_files as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($attendanceManagement->members_in_attendances as $key => $item)
                                    <span class="badge badge-info">{{ $item->member_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\AttendanceManagement::AGE_CATEGORY_SELECT[$attendanceManagement->age_category] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\AttendanceManagement::GENDER_CATEGORY_SELECT[$attendanceManagement->gender_category] ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->state_of_the_flock ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->cih_centre->zone ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $attendanceManagement->present ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $attendanceManagement->present ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $attendanceManagement->absent ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $attendanceManagement->absent ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $attendanceManagement->excused ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $attendanceManagement->excused ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('attendance_management_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.attendance-managements.show', $attendanceManagement->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('attendance_management_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.attendance-managements.edit', $attendanceManagement->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('attendance_management_delete')
                                    <form action="{{ route('admin.attendance-managements.destroy', $attendanceManagement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('attendance_management_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.attendance-managements.massDestroy') }}",
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
    order: [[ 5, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-membersInAttendanceAttendanceManagements:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection