@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.attendanceManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendance-managements.store") }}" enctype="multipart/form-data" id="AttendanceForm">
        @method('PUT')
            @csrf
            <div class="form-group">
                <label for="meeting_title_id">{{ trans('cruds.attendanceManagement.fields.meeting_title') }}</label>
                <select class="form-control select2 {{ $errors->has('meeting_title') ? 'is-invalid' : '' }}" name="meeting_title_id" id="meeting_title_id" onchange="onMeeting_title()">
                    @foreach($meeting_titles as $id => $entry)
                        <option value="{{ $id }}" {{ old('meeting_title_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('meeting_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.meeting_title_helper') }}</span>
            </div>

            <div class="form-group">
                <input name="meeting_type_id" id="meeting_type_id" hidden/>
                <label for="meeting_type_id">{{ trans('cruds.attendanceManagement.fields.meeting_type') }}</label>
                <select class="form-control select2 {{ $errors->has('meeting_type') ? 'is-invalid' : '' }}" name="meeting_type_id_list" id="meeting_type_id_list">
                    @foreach($meeting_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('meeting_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('meeting_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.meeting_type_helper') }}</span>
            </div>
            <div id="timerPanel" style="display: none;">
                <div class="shadow p-3 mb-5  rounded" style="width: 450px; height: 145px; margin:auto; background-color: #fcfdff; box-shadow: 0 .3rem 1rem 0.4em rgba(0,0,21,.15)!important; text-align:center;">
                    <span class="" style="margin-left: calc(335px - 20px); margin-top:-10px" id="status"></span>
                <div style="margin-top: -15px;">
                        <label style="display:block;margin-top:-10px;" id="time"></label>
                        <!-- font-family: 'Segment7Standard'; -->
                        <label style="font-weight: normal;font-style: italic; font-size: 50px; text-align:center; margin:auto;display:block; margin-top:-20px;" id="timer">00:00:00</label>
                        <label style="display:block;margin-top:-15px;font-weight: bold;">Date of Attendance</label>
                        <!-- <label style="display:block;margin-top:-10px;" id="date_of_meeting"></label> -->

                           <ul style="display:block;margin-top:-10px; list-style: none;" >
                                <li class="nav-item dropdown" id="dropdown">
                                <a class="nav-link dropdown-toggle" id="date_of_meeting" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black !important;">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="date_of_meeting" style="margin-left: 100px;" id="date_of_meeting_list">
                                    <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li> -->

                                </ul>
                                </li>
                            </ul>


                </div>

                </div>
                <div style="width: 300px; margin:auto; margin-top:-40px;text-align:center; ">
                    <a class="btn btn-xs btn-success" style="color: white;" id="reschedule" onclick="onreschedule()">
                        Reschedule Meeting
                    </a>
                    <a class="btn btn-xs btn-danger" style="color: white;" id="canceled" onclick="oncancelDialog()">
                        Cancel Meeting
                    </a>
                    <a class="btn btn-xs btn-danger" style="color: white;" id="closed" onclick="OnClosed()">
                        Close Meeting
                    </a>
                    <a class="btn btn-xs btn-warning" style="color: white;" id="viewList" onclick="loadDialog()">
                        View Date List
                    </a>
                </div>
            </div>
            <div class="form-group" style="display: none;">
                <label for="date">{{ trans('cruds.attendanceManagement.fields.date') }}</label>
                <input class="form-control {{ $errors->has('dateData') ? 'is-invalid' : '' }}" type="text" name="dateData" id="date" value="{{ old('dateData') }}" hidden>
                <input class="form-control {{ $errors->has('timeData') ? 'is-invalid' : '' }}" type="text" name="timeData" id="timeData" value="{{ old('timeData') }}" hidden>
                @if($errors->has('dateData'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dateData') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.date_helper') }}</span>
            </div>
            <diV>
            <div id="tempalete" style="display: none;">
            <div class="form-group">
                <label for="summary_report">{{ trans('cruds.attendanceManagement.fields.summary_report') }}</label>
                <textarea class="form-control {{ $errors->has('summary_report') ? 'is-invalid' : '' }}" name="summary_report" id="summary_report">{{ old('summary_report') }}</textarea>
                @if($errors->has('summary_report'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summary_report') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.summary_report_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="external_files">{{ trans('cruds.attendanceManagement.fields.external_files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('external_files') ? 'is-invalid' : '' }}" id="external_files-dropzone">
                </div>
                @if($errors->has('external_files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('external_files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.external_files_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="members_in_attendances">{{ trans('cruds.attendanceManagement.fields.members_in_attendance') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('members_in_attendances') ? 'is-invalid' : '' }}" name="members_in_attendancesL[]" id="members_in_attendances" multiple onchange="OnchangeAttendees()">

                </select>
                @if($errors->has('members_in_attendances'))
                    <div class="invalid-feedback">
                        {{ $errors->first('members_in_attendances') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.members_in_attendance_helper') }}</span>

                <div class="form-group">
                    <label class="" for="members_in_attendances">Member that take excuse</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('members_in_attendances') ? 'is-invalid' : '' }}" name="members_in_excuse[]" id="members_in_excuse" multiple onchange="OnchangeExcuses()">

                    </select>
                    @if($errors->has('members_in_attendances'))
                        <div class="invalid-feedback">
                            {{ $errors->first('members_in_attendances') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.attendanceManagement.fields.members_in_attendance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="" for="members_in_attendances">Absence Member</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('members_in_attendances') ? 'is-invalid' : '' }}" name="members_in_absence[]" id="members_in_absence" multiple  >

                    </select>
                    @if($errors->has('members_in_attendances'))
                        <div class="invalid-feedback">
                            {{ $errors->first('members_in_attendances') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.attendanceManagement.fields.members_in_attendance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.attendanceManagement.fields.age_category') }}</label>
                    <select class="form-control {{ $errors->has('age_category') ? 'is-invalid' : '' }}" name="age_category" id="age_category">
                        <option value disabled {{ old('age_category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\AttendanceManagement::AGE_CATEGORY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('age_category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('age_category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('age_category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.attendanceManagement.fields.age_category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.attendanceManagement.fields.gender_category') }}</label>
                    <select class="form-control {{ $errors->has('gender_category') ? 'is-invalid' : '' }}" name="gender_category" id="gender_category">
                        <option value disabled {{ old('gender_category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\AttendanceManagement::GENDER_CATEGORY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender_category', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender_category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('gender_category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.attendanceManagement.fields.gender_category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="state_of_the_flock">{{ trans('cruds.attendanceManagement.fields.state_of_the_flock') }}</label>
                    <input class="form-control {{ $errors->has('state_of_the_flock') ? 'is-invalid' : '' }}" type="email" name="state_of_the_flock" id="state_of_the_flock" value="{{ old('state_of_the_flock') }}">
                    @if($errors->has('state_of_the_flock'))
                        <div class="invalid-feedback">
                            {{ $errors->first('state_of_the_flock') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.attendanceManagement.fields.state_of_the_flock_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cih_centre_id">{{ trans('cruds.attendanceManagement.fields.cih_centre') }}</label>
                    <select class="form-control select2 {{ $errors->has('cih_centre') ? 'is-invalid' : '' }}" name="cih_centre_id" id="cih_centre_id">
                        @foreach($cih_centres as $id => $entry)
                            <option value="{{ $id }}" {{ old('cih_centre_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('cih_centre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cih_centre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.attendanceManagement.fields.cih_centre_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </diV>

        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rescheduledModal" tabindex="-1" role="dialog" aria-labelledby="rescheduledModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rescheduledLabel">Reschedule Meeting</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="reason">Current Date</label>
                <input class="form-control" id="oldDate" readonly/>

            </div>

            <div class="form-group">
                <label for="reason">Current Time</label>
                <input class="form-control" id="oldTime" readonly/>

            </div>

            <div class="form-group">
                <label for="reason">New Date</label>
                <input class="form-control" id="newDate"/>

            </div>
            <div class="form-group">
                <label for="reason">{{ trans('cruds.joinDepartment.fields.reason') }}</label>
                <input class="form-control timepicker" id="newtime"/>

            </div>
            <div class="form-group">
                <label for="reason">{{ trans('cruds.joinDepartment.fields.reason') }}</label>
                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" id="reason"></textarea>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Rescheduled()">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="CancelModal" tabindex="-1" role="dialog" aria-labelledby="rescheduledModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CancelLabel">Cancel Meeting</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="reason">Current Date</label>
                <input class="form-control" id="canceloldDate" readonly/>

            </div>

            <div class="form-group">
                <label for="reason">Current Time</label>
                <input class="form-control" id="canceloldTime" readonly/>

            </div>


            <div class="form-group">
                <label for="reason">{{ trans('cruds.joinDepartment.fields.reason') }}</label>
                <textarea class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" id="cancelreason"></textarea>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Canceled()">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="dateListmodal" tabindex="-1" role="dialog" aria-labelledby="dateListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModal">Date list</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="table-responsive" style="width: 100% !important">
                    <table class="table table-bordered table-striped table-hover datatable" id="dateListTable" style="width: 100% !important">
                        <thead style="width: 100% !important;">
                            <tr>
                                <th>
                                    Sn
                                </th>
                                <th>
                                    Date(MM-DD-MMM)
                                </th>
                                <th>
                                    Day in a Week
                                </th>
                                <th>
                                    Time
                                </th>
                                <th>
                                    Status
                                </th>

                            </tr>
                        </thead>
                    </table>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary" onclick="onDelistAMember()">Delist Member</button> -->
        </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
    var uploadedExternalFilesMap = {}
Dropzone.options.externalFilesDropzone = {
    url: '{{ route('admin.attendance-managements.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="external_files[]" value="' + response.name + '">')
      uploadedExternalFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedExternalFilesMap[file.name]
      }
      $('form').find('input[name="external_files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($attendanceManagement) && $attendanceManagement->external_files)
          var files =
            {!! json_encode($attendanceManagement->external_files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="external_files[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>

<script>
    var pendingDate;
    var meetData;
    var timer;
    var dateListTable;
    var attendeeList = [], attend = [], absence = [], excuse = [];
    $(document).ready(() =>{
        $('#AttendanceForm').remove('input[name=_method]');
        $('input[name=_method]').remove();

        $('#newDate').datetimepicker({
                format: 'MM-DD-YYYY',
                locale: 'en',
                icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
            }
        });
        $("#meeting_type_id_list").select2({
            disabled: true
        });
        $("#members_in_attendances").on("dp.change", function() {

           // OnchangeAttendees();
        });

        dateListTable =  $('#dateListTable').DataTable(
            {
                destroy: true,
                data: [],
                processing: true,
                buttons: [],
                pageLength: 10,
                responsive: true,
                columns: [
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            targets: 0,
                            render: function (data, type, full, meta) {
                                return (meta.row+ 1);
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            targets: 1,
                            render: function (data, type, full, meta) {

                                return `<span>${data.date}</span>`;
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            render: function (data, type, full, meta) {
                                return `<span>${GetDayinWeek(data.date)}</span>`;
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            render: function (data, type, full, meta) {
                                return `<span>${data.time}</span>`;
                            }
                    },
                    {
                            className: 'none',
                            data: null,
                            defaultContent: '',
                            render: function (data, type, full, meta) {
                                console.log(data);
                                if(data.status === 'active'){
                                    return `<span class="btn btn-xs btn-success" style="color: white;">Active</span>`;
                                } else if(data.status === 'Closed'){
                                    return `<span class="btn btn-xs btn-info" style="color: white;">Closed</span>`;
                                }else if(data.status === 'Canceled'){
                                    return `<span class="btn btn-xs btn-danger" style="color: white;">Canceled</span>`;
                                }else if(data.status === 'awaiting'){
                                    return `<span class="btn btn-xs btn-warning" style="color: white;">Pending</span>`;
                                } else{
                                    return `<span class="btn btn-xs btn-secondary" style="color: white;">Not Yet Started</span>`;
                                }

                            }
                    },
                ]

            });


            $('#dropdown').click(function(){

                $('#date_of_meeting_list').toggleClass('show');

            });

            $("button[data-bs-dismiss=modal]").click(function()
            {
                $(".modal").modal('hide');
            });
    });

    function onMeeting_title(){
        var meeting_title_Id = $('#meeting_title_id').val();
        Get(`/admin/meetings/GetMeetingById/${meeting_title_Id}`,true).then(res => {
            if(res == null) return;
            meetData = res;
            buildJson(res);
            Get(`/admin/attendance-managements/GetAttendees/${meeting_title_Id}`).then(data => {
                const dt = data.map((v,i)=> {
                    return {id:v.id,text:v.member_name};
                });
                attend = dt;
                absence= dt;
                excuse = dt;
                $("#members_in_attendances").select2({ data: attend });
                $("#members_in_excuse").select2({ data: excuse  });
                $("#members_in_absence").select2({ data: absence });
            });

        });
    }


    function OnchangeAttendees(){
        var att = $('#members_in_attendances').val();
        console.log(att);
        var ex = (() => excuse)() ;
        var ab = absence;
        $.each(att, (i, v) => {
            var excusIdex =ex.findIndex(x => x.id == v);
            if(excusIdex > -1){
                ex = ex.slice(excusIdex+1, 1);
            }
        });
        $('#members_in_excuse').empty();//.trigger("change");
        $("#members_in_excuse").select2({ data: ex  });
        $.each(att, (i, v) => {
            var absenceIdex =ab.findIndex(x => x.id == v);
            if(absenceIdex > -1){
                ab = ab.slice(absenceIdex+1, 1);
            }
        });

        $('#members_in_absence').empty();//.trigger("change");
        $("#members_in_absence").select2({ data: ab  });
    }

    function OnchangeExcuses(){
        var att = $('#members_in_excuse').val();
        if(att == undefined) return;
        $('#members_in_absence').empty();
        var ab = absence;
        $.each(att, (i, v) => {
            var absenceIdex =ab.findIndex(x => x.id == v);
            if(absenceIdex > -1){
                ab = ab.slice(absenceIdex+1, 1);
            }
        });
        $("#members_in_absence").select2({ data: ab  });
    }
    function Awaiting(date, name){
        clearInterval(timer);

        $('#date_of_meeting_list').children().each(function(idx, val){
            $(`#itemDate${idx}`).removeClass('active');
        });
        $(`#${name}`).addClass('active');
        buildJson(meetData, 'awaiting');
        document.getElementById('tempalete').style.display = 'none';
    }
    function Active(date, name){
        clearInterval(timer);

        $('#date_of_meeting_list').children().each(function(idx, val){
            $(`#itemDate${idx}`).removeClass('active');
        });
        $(`#${name}`).addClass('active');
        buildJson(meetData, 'active');
        document.getElementById('tempalete').style.display = 'none';
    }
    function Closed(date, name){
        clearInterval(timer);

        $('#date_of_meeting_list').children().each(function(idx, val){
            $(`#itemDate${idx}`).removeClass('active');
        });
        var date_of_meetingList = JSON.parse(meetData.date_of_meeting);
        $(`#${name}`).addClass('active');
        pendingDate = date_of_meetingList.find(x => x.status == 'Closed' && x.date == date);
        document.getElementById('status').innerText =pendingDate.status == 'awaiting'?'Pending':pendingDate.status == 'active'?'Active':pendingDate.status;
        document.getElementById('status').className = `btn btn-xs ${pendingDate.status=='awaiting'?'btn-secondary':pendingDate.status=='active'?'btn-success':'btn-danger'}`;
        document.getElementById('date_of_meeting').innerText =pendingDate.date;
        document.getElementById('time').innerText =pendingDate.time;
        document.getElementById('timer').innerHTML = '00:00:00';
        document.getElementById('date_of_meeting').innerHTML = pendingDate.date;
        document.getElementById('tempalete').style.display = '';
        document.getElementById('reschedule').style.display = 'none';
            document.getElementById('canceled').style.display = 'none';
            document.getElementById('closed').style.display = 'none';
        $('#date').val(pendingDate.date);
        $('#timeData').val(pendingDate.time);
        return Get(`/admin/attendance-managements/GetMeetingAttendance/${meetData.meeting_type_id}/${meetData.id}/${pendingDate.date}/${pendingDate.time}`, true).then(res => {
            if(res != null && res !== ''){
                 $('#date').val(res.dateData);
                 $('#timeData').val(res.timeData);
                 $('#summary_report').val(res.summary_report);
                 $('#members_in_attendances').val(JSON.parse(res.members_in_attendancesL??'[]')).trigger('change');
                 $('#members_in_excuse').val(JSON.parse(res.members_in_excuse??'[]')).trigger('change');
                 $('#members_in_absence').val(JSON.parse(res.members_in_absence??'[]')).trigger('change');
                 $('#age_category').val(res.age_category);
                 $('#gender_category').val(res.gender_category);
                 $('#state_of_the_flock').val(res.state_of_the_flock);
                 $('#cih_centre_id').val(res.cih_centre_id).trigger('change');
                 //$('#age_category').val(res.age_category);
                 $('#AttendanceForm').attr('action', `{{ route("admin.attendance-managements.update","@id") }}`.replace('@id', res.id));
                 $("#AttendanceForm").attr("method", "post");


                 $('#AttendanceForm').append('<input type="hidden" name="_method" value="PUT">');
                 $('[name=_method]').val('PUT');

            } else {
               // $('#date').val(pendingDate.dateData);

                $('#summary_report').val('');
                $('#members_in_attendances').val([]).trigger('change');
                $('#members_in_excuse').val([]).trigger('change');
                $('#members_in_absence').val([]).trigger('change');
                $('#age_category').val('');
                $('#gender_category').val('');
                $('#state_of_the_flock').val('');
                $('#cih_centre_id').val(null).trigger('change');

                $('#AttendanceForm').attr('action', `{{ route("admin.attendance-managements.store")}}`);
                $("#AttendanceForm").attr("method", "post");
                //$('[name=_method]').val('PUT')
                $('#AttendanceForm').remove('input[name=_method]');
                $('input[name=_method]').remove();
            }


        });
    }
    function Cancel(date, name){
        ErrorNotification('This meeting has been cancel, please kindly a valid meeting date');
    }
    function YetNotStarted(date, name){
        ErrorNotification('This meeting is not started, please kindly wait');
    }
    function buildJson(data, status = 'awaiting'){
        $('#meeting_type_id').val(data.meeting_type_id);
        $('#meeting_type_id_list').val(data.meeting_type_id).trigger('change');
        var date_of_meetingList = JSON.parse(data.date_of_meeting);

        pendingDate = date_of_meetingList.find(x => x.status == status);
        if(pendingDate == null || pendingDate == undefined){
            pendingDate = date_of_meetingList.find(x => x.status == 'active');
        }
        $('#date_of_meeting_list').empty();
        $.each(date_of_meetingList, (i, v) => {
            if(v.status === 'awaiting'){
                $('#date_of_meeting_list').append(`<li><a class="dropdown-item ${v.date === pendingDate.date && v.time === pendingDate.time?'active':''}"  id="itemDate${i}" onclick="Awaiting('${v.date}', 'itemDate${i}')">${v.date}</a></li>`);
            } else if(v.status === 'active'){
                $('#date_of_meeting_list').append(`<li><a class="dropdown-item ${v.date === pendingDate.date && v.time === pendingDate.time?'active':''}"  id="itemDate${i}" onclick="Active('${v.date}', 'itemDate${i}')">${v.date}</a></li>`);
            } else if(v.status === 'Closed'){
                $('#date_of_meeting_list').append(`<li><a class="dropdown-item ${v.date === pendingDate.date && v.time === pendingDate.time?'active':''}"  id="itemDate${i}" onclick="Closed('${v.date}', 'itemDate${i}')">${v.date}</a></li>`);
            } else if(v.status === 'Canceled'){
                $('#date_of_meeting_list').append(`<li><a class="dropdown-item ${v.date === pendingDate.date && v.time === pendingDate.time?'active':''}"  id="itemDate${i}" onclick="Cancel('${v.date}', 'itemDate${i}')">${v.date}</a></li>`);
            } else {
                $('#date_of_meeting_list').append(`<li><a class="dropdown-item ${v.date === pendingDate.date && v.time === pendingDate.time?'active':''}"  id="itemDate${i}" onclick="YetNotStarted('${v.date}')">${v.date}</a></li>`);
            }

        });

        document.getElementById('status').innerText =pendingDate.status == 'awaiting'?'Pending':pendingDate.status == 'active'?'Active':'Canceled';
        document.getElementById('status').className = `btn btn-xs ${pendingDate.status=='awaiting'?'btn-secondary':pendingDate.status=='active'?'btn-success':'btn-danger'}`;
        document.getElementById('date_of_meeting').innerText =pendingDate.date;
        document.getElementById('time').innerText =pendingDate.time;
        $('#date').val(pendingDate.date);
        var dt =new Date(`${pendingDate.date}, ${pendingDate.time}`);
        var countDownDate = dt.getTime();
        var changeStatusToActive = 0;
        if(pendingDate.status == 'awaiting'){
            document.getElementById('reschedule').style.display = '';
            document.getElementById('canceled').style.display = '';
            document.getElementById('closed').style.display = 'none';

        } else if(pendingDate.status == 'active'){
            document.getElementById('reschedule').style.display = 'none';
            document.getElementById('canceled').style.display = 'none';
            document.getElementById('closed').style.display = '';
        }
        else {
            document.getElementById('reschedule').style.display = 'none';
            document.getElementById('canceled').style.display = 'none';
            document.getElementById('closed').style.display = 'none';
        }
         document.getElementById('timerPanel').style.display = 'block';
         document.getElementById('tempalete').style.display = 'none';
        timer = setInterval(function() {

            // Get today's date and time 05-02-2023
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("timer").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                //clearInterval(x);
                if(changeStatusToActive == 0){
                    let dtstatus = {
                        id : data.id,
                        date: pendingDate.date,
                        time: pendingDate.time,
                        status: 'active'
                    };
                    Post('/admin/attendance-managements/updateStatus', dtstatus);
                    document.getElementById('status').innerText = 'Active';
                    document.getElementById('status').className ='btn btn-xs btn-success';
                    changeStatusToActive = 1;
                    pendingDate.status = 'active';
                    if(pendingDate.status == 'awaiting'){
                        document.getElementById('reschedule').style.display = '';
                        document.getElementById('canceled').style.display = '';
                        document.getElementById('closed').style.display = 'none';

                    } else if(pendingDate.status == 'active'){
                        document.getElementById('reschedule').style.display = 'none';
                        document.getElementById('canceled').style.display = 'none';
                        document.getElementById('closed').style.display = '';
                    }
                    else {
                        document.getElementById('reschedule').style.display = 'none';
                        document.getElementById('canceled').style.display = 'none';
                        document.getElementById('closed').style.display = 'none';
                    }
                }

                var distance =  now - countDownDate;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("timer").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

                 //document.getElementById("timer").innerHTML = "EXPIRED";
            }
        }, 1000);
    }

    function Rescheduled(){
       var newDate =  $('#newDate').val();
       var newtime = $('#newtime').val();
       var reason = $('#reason').val();
       if(newDate === ''){
         ErrorNotification('Please kindly supply a valid new date');
         return;
       }else if(newtime === ''){
         ErrorNotification('Please kindly supply a valid new time');
         return;
       }else if(reason === ''){
         ErrorNotification('Please kindly supply a valid  reason');
         return;
       }
        let dtstatus = {
            id : meetData.id,
            previousdate: pendingDate.date,
            previoustime: pendingDate.time,
            currentdate: newDate,
            currenttime: newtime,
            comment: reason
        };
        Post('/admin/attendance-managements/rescheduleStatus', dtstatus, true).then(res => {
            SuccessNotification(res);
            clearInterval(timer);
            onMeeting_title();
            $('#rescheduledModal').modal('hide');
        });
    }

    function onreschedule(){
        $('#oldDate').val(pendingDate.date);
        $('#oldTime').val(pendingDate.time);
        $('#rescheduledModal').modal('show');

    }

    function oncancelDialog(){
        $('#canceloldDate').val(pendingDate.date);
        $('#canceloldTime').val(pendingDate.time);
        $('#CancelModal').modal('show');
    }

    function Canceled(){
       var newDate =  $('#canceloldDate').val();
       var reason = $('#cancelreason').val();
       if(newDate === ''){
         ErrorNotification('Please kindly supply a valid  date');
         return;
       }else if(reason === ''){
         ErrorNotification('Please kindly supply a valid  reason');
         return;
       }
        let dtstatus = {
            id : meetData.id,
            date: pendingDate.date,
            time:pendingDate.time,
            comment: reason
        };
        Post('/admin/attendance-managements/cancelStatus', dtstatus, true).then(res => {
            SuccessNotification(res);
            clearInterval(timer);
            onMeeting_title();
            $('#CancelModal').modal('hide');
        });
    }

    function OnClosed(){
        AskQuestion('Are you sure you want to close this meeting').then(opt => {
            if(opt){
                let dtstatus = {
                id : meetData.id,
                date: pendingDate.date,
                time: pendingDate.time,
                comment: 'Closed'
            };
            Post('/admin/attendance-managements/closeStatus', dtstatus, true).then(res => {
                SuccessNotification(res);
                clearInterval(timer);
                onMeeting_title();
                //$('#CancelModal').modal('hide');
            });
            }
        })

    }

    function loadDialog(){
        Get(`/admin/meetings/GetMeetingById/${meetData.id}`,true).then(res => {
            if(res == null) return;

            var dt = JSON.parse(res.date_of_meeting);
            $('#dateListmodal').modal('show');
            dateListTable.clear().draw();
            dateListTable.rows.add(dt).draw();

            setTimeout(function(){
                dateListTable.columns.adjust()

            },300);
        });

    }

    function GetDayinWeek(date){
        const weeks = [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];
        var dt  = new Date(date);
        return weeks[dt.getDay()];
    }
</script>
@endsection
