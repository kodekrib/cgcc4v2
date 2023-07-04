@extends('layouts.admin')
@section('content')
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
            <table class=" table table-bordered table-striped table-hover datatable datatable-AttendanceManagement">
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
                            {{ trans('cruds.meeting.fields.meeting_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.date') }}
                        </th>
                        <th>

                            Time of Attendance

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
                            Members that take Excuse
                        </th>
                        <th>
                            Members In Absence
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
                                {{ $attendanceManagement->dateData ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->timeData ?? '' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->summary_report ?? 'N/A' }}
                            </td>
                            <td>
                                @if(count($attendanceManagement->external_files) > 0)
                                    @foreach($attendanceManagement->external_files as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-success" href="#"  onclick="onAttendee('{{$attendanceManagement->id }}')">
                                       Attendee
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-xs btn-warning" href="#" onclick="onExcuse('{{$attendanceManagement->id }}')" >
                                       Excused Member
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-xs btn-danger" href="#" onclick="onAbsence('{{$attendanceManagement->id }}')" >
                                       Absence Member
                                </a>
                            </td>
                            <td>
                                {{ App\Models\AttendanceManagement::AGE_CATEGORY_SELECT[$attendanceManagement->age_category] ?? 'N/A' }}
                            </td>
                            <td>
                                {{ App\Models\AttendanceManagement::GENDER_CATEGORY_SELECT[$attendanceManagement->gender_category] ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->state_of_the_flock ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $attendanceManagement->cih_centre->zone ?? 'N/A' }}
                            </td>

                            <td>
                                @can('attendance_management_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.attendance-managements.show', $attendanceManagement->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                <!-- @can('attendance_management_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.attendance-managements.edit', $attendanceManagement->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan -->

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


<!-- Modal -->
<div class="modal fade" id="addMoreModal" tabindex="-1" role="dialog" aria-labelledby="addMoreModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMoreModal">Member list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="table-responsive" style="width: 100% !important">
                    <table class="table table-bordered table-striped table-hover datatable" id="memberTable">
                        <thead style="width: 100% !important;">
                            <tr>
                                <th>
                                    Member Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone Number
                                </th>

                            </tr>
                        </thead>
                    </table>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary" onclick="onDelistAMember()">Delist Member</button> -->
        </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
@parent
<script>
    var tableList;
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
  let table = $('.datatable-AttendanceManagement:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});



</script>
<script>
    $(document).ready(() => {

    });

    tableList =  $('#memberTable').DataTable({
                destroy: true,
                processing: true,
                data : [],
                buttons: [],
                processing: true,
                columns: [
                    {
                        className: 'none',
                        data: 'member_name',
                        defaultContent: '',
                        render: function (data, type, full, meta) {
                            return data;
                        }
                    },

                    { data: 'email', name: 'email' },
                    { data: 'mobile', name: 'mobile' },
                ],

            });

    function onAttendee(Id){
        GetAttendants(Id, 'attendee').then(data => {
            $('#addMoreModal').modal('show');
            tableList.clear().draw();
            tableList.rows.add(data).draw();
        });
    }

    function onExcuse(Id){
        GetAttendants(Id, 'excuse').then(data => {
            $('#addMoreModal').modal('show');
            tableList.clear().draw();
            tableList.rows.add(data).draw();
        });
    }
    function onAbsence(Id){
        GetAttendants(Id, 'absence').then(data => {
            $('#addMoreModal').modal('show');
            tableList.clear().draw();
            tableList.rows.add(data).draw();
        });
    }
    function GetAttendants(Id, type){
        return Get(`/admin/attendance-managements/GetAttendants/${Id}/${type}`, true);
    }
</script>
@endsection
