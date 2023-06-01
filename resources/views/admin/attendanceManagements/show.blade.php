@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.attendanceManagement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendance-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.id') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.meeting_type') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->meeting_type->types ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.meeting_title') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->meeting_title->meeting_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.date') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->dateData }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.summary_report') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->summary_report??'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.external_files') }}
                        </th>
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
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.members_in_attendance') }}
                        </th>
                        <td>
                            <a class="btn btn-xs btn-success" href="#"  onclick="onAttendee('{{$attendanceManagement->id }}')">
                                       Attendee
                                </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Members that take Excuse
                        </th>
                        <td>
                        <a class="btn btn-xs btn-warning" href="#" onclick="onExcuse('{{$attendanceManagement->id }}')" >
                                       Excused Member
                                </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Members In Absence
                        </th>
                        <td>
                        <a class="btn btn-xs btn-danger" href="#" onclick="onAbsence('{{$attendanceManagement->id }}')" >
                                       Absence Member
                                </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.age_category') }}
                        </th>
                        <td>
                            {{ App\Models\AttendanceManagement::AGE_CATEGORY_SELECT[$attendanceManagement->age_category] ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.gender_category') }}
                        </th>
                        <td>
                            {{ App\Models\AttendanceManagement::GENDER_CATEGORY_SELECT[$attendanceManagement->gender_category] ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.state_of_the_flock') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->state_of_the_flock?? 'N/A'  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attendanceManagement.fields.cih_centre') }}
                        </th>
                        <td>
                            {{ $attendanceManagement->cih_centre->zone ?? 'N/A'  }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attendance-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
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
<script>
    var tableList;
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
