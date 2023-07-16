@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.meeting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.meetings.update", [$meeting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="meeting_type_id">{{ trans('cruds.meeting.fields.meeting_type') }}</label>
                <select class="form-control select2 {{ $errors->has('meeting_type') ? 'is-invalid' : '' }}" name="meeting_type_id" id="meeting_type_id">
                    @foreach($meeting_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('meeting_type_id') ? old('meeting_type_id') : $meeting->meeting_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('meeting_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.meeting_type_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('re_occurence') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="re_occurence" value="{{$meeting->re_occurence}}">
                    <input class="form-check-input" type="checkbox" name="re_occurence" id="re_occurence" value="1" {{ old('re_occurence', $meeting->re_occurence) == 1 ? 'checked' : $meeting->re_occurence}} onchange="reoccurence()">
                    <label class="form-check-label" for="re_occurence">Re-ocurrence</label>
                </div>
                @if($errors->has('re_occurence'))
                    <div class="invalid-feedback">
                        {{ $errors->first('re_occurence') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.disapproved_helper') }}</span>
            </div>
            <input type="hidden" name="re_occurence_json"  id="re_occurence_json" value="{{ old('re_occurence_json', $meeting->re_occurence_json) }}">

            <div class="shadow p-3 mb-5  rounded" style="background-color: #f2f2f0;" id="container_re_occur" style="display: none;" >
                    <div class ="row">
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('re_occurence') ? 'is-invalid' : '' }}">

                            <input class="form-check-input" type="radio" name="optionType" id="optionType2" value="specific" checked onchange="onChangeoptionType('optionType2')">
                            <label class="form-check-label" for="optionType2" >Specific Date in a Month</label>
                        </div>
                        <div class="form-check {{ $errors->has('re_occurence') ? 'is-invalid' : '' }}">

                            <input class="form-check-input" type="radio" name="optionType" id="optionType1" value="frequency"  onchange="onChangeoptionType('optionType1')">
                            <label class="form-check-label" for="optionType1" >Frequency</label>
                        </div>


                        <div class="form-check {{ $errors->has('re_occurence') ? 'is-invalid' : '' }}">

                            <input class="form-check-input" type="radio" name="optionType" id="optionType3" value="interval"  onchange="onChangeoptionType('optionType3')">
                            <label class="form-check-label" for="optionType3" >Interval</label>
                        </div>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-2 form-group">
                            <label class="required" for="year">Current Year</label>
                            <input class="form-control  {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ now()->year }}" disabled>
                        </div>

                        <div class="col-3 form-group" id="container_start_date">
                            <label class="required" for="start_date">Start Date</label>
                            <input class="form-control " type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                        </div>
                        <div class="col-3 form-group" id="container_specific_date">
                            <label class="required" for="specific_date">Specific Date</label>

                            <select class="form-control " name="specific_date" id="specific_date" onchange="DateListSpecificCalculation()">
                            </select>
                        </div>
                        <div class="col-3 form-group" id="container_dayinaWeek">
                            <label class="required" for="interval">Day in a Week</label>
                            <select class="form-control select2" name="dayinaWeek" id="dayinaWeek" onchange="DateListfrequecyCalculation()" multiple>

                                    <option value="1" >Sunday</option>
                                    <option value="2" >Monday</option>
                                    <option value="3" >Tuesday</option>
                                    <option value="4" >Wednesday</option>
                                    <option value="5" >Thursday</option>
                                    <option value="6" >Friday</option>
                                    <option value="7" >Saturday</option>

                            </select>
                        </div>
                        <div class="col-2 form-group">
                            <label class="required" for="start_time2">Time</label>
                            <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time2" value="{{ old('start_time') }}">
                        </div>
                        <div class="col-2 form-group" id="container_interval">
                            <label class="required" for="interval">Interval in days</label>
                            <input class="form-control {{ $errors->has('interval') ? 'is-invalid' : '' }}" type="number" name="interval" id="interval" value="{{ old('interval') }}" onchange="DateListIntevalCalculation()">
                        </div>
                        <div class="col-3 form-group" id="container_frequency">
                            <label class="required" for="interval">Frequency</label>
                            <select class="form-control  select2" name="frequency" id="frequency" onchange="DateListfrequecyCalculation()" value="[]" multiple="multiple">

                                    <option value="1" >First Week Month</option>
                                    <option value="2" >Second Week Month</option>
                                    <option value="3" >Third Week Month</option>
                                    <option value="4" >Fourth Week Month</option>
                                    <option value="5" >Fifth Week Month</option>

                            </select>
                        </div>
                        <div class="col-2 form-group" id="container_end_date">
                            <div>
                                <label class="required" for="end_date">End Date</label>
                                <a class="btn btn-xs btn-success" style="color: white; float:right;" id="btnViewDate" onclick="onShowDateList()">
                                            View Date List
                                </a>
                            </div>

                            <input class="form-control  {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="" disabled>
                        </div>
                    </div>
            </div>
            <input class="form-control {{ $errors->has('date_of_meeting') ? 'is-invalid' : '' }}"  type="text" name="date_of_meeting" id="date_of_meeting" hidden value="{{ old('date_of_meeting') }}">
            <div id="once">

                <div class="form-group">
                    <label for="date_static">{{ trans('cruds.meeting.fields.date_of_meeting') }}</label>
                    <input class="form-control {{ $errors->has('date_static') ? 'is-invalid' : '' }}" type="text" name="date_static" id="date_static" value="{{ old('date_static') }}">
                    @if($errors->has('date_of_meeting'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date_of_meeting') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.meeting.fields.date_of_meeting_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="start_time">Time</label>
                    <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('time_duration', '') }}">
                    @if($errors->has('start_time'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_time') }}
                        </div>
                    @endif
                    <!-- <span class="help-block">{{ trans('cruds.meeting.fields.time_duration_helper') }}</span> -->
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="date_of_meeting">{{ trans('cruds.meeting.fields.date_of_meeting') }}</label>
                <input class="form-control date {{ $errors->has('date_of_meeting') ? 'is-invalid' : '' }}" type="text" name="date_of_meeting" id="date_of_meeting" value="{{ old('date_of_meeting', $meeting->date_of_meeting) }}">
                @if($errors->has('date_of_meeting'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_meeting') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.date_of_meeting_helper') }}</span>
            </div> -->
            <div class="form-group">
                <label for="time_duration">{{ trans('cruds.meeting.fields.time_duration') }}</label>
                <input class="form-control {{ $errors->has('time_duration') ? 'is-invalid' : '' }}" type="text" name="time_duration" id="time_duration" value="{{ old('time_duration', $meeting->time_duration) }}">
                @if($errors->has('time_duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.time_duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meeting_title">{{ trans('cruds.meeting.fields.meeting_title') }}</label>
                <input class="form-control {{ $errors->has('meeting_title') ? 'is-invalid' : '' }}" type="text" name="meeting_title" id="meeting_title" value="{{ old('meeting_title', $meeting->meeting_title) }}" required>
                @if($errors->has('meeting_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.meeting_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="venue_id">{{ trans('cruds.meeting.fields.venue') }}</label>
                <select class="form-control select2 {{ $errors->has('venue') ? 'is-invalid' : '' }}" name="venue_id" id="venue_id" required>
                    @foreach($venues as $id => $entry)
                        <option value="{{ $id }}" {{ (old('venue_id') ? old('venue_id') : $meeting->venue->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('venue'))
                    <div class="invalid-feedback">
                        {{ $errors->first('venue') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.venue_helper') }}</span>
            </div>
            <!-- <div class="form-group">
                <label for="attendees_id">{{ trans('cruds.meeting.fields.attendees') }}</label>
                <select class="form-control select2 {{ $errors->has('attendees') ? 'is-invalid' : '' }}" name="attendees_id" id="attendees_id">
                    @foreach($attendees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('attendees_id') ? old('attendees_id') : $meeting->attendees->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('attendees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.attendees_helper') }}</span>
            </div> -->

            <div class="form-group">
                <input hidden name="attendees_id_list" id="attendees_id_list" value="{{$meeting->attendees_id_list}}" />
                <div class="card border-success mb-3" >
                    <div class="card-header" style="background-color: #f2f2f0;">Attendee List</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4" >
                                <div class="form-group">
                                    <label for="selected_groups">Group</label>
                                    <select class="form-control  {{ $errors->has('selected_groups') ? 'is-invalid' : '' }}" name="selected_groups" id="selected_groups" onchange="onSelectGroup()">
                                        <option value disabled {{ old('selected_groups', $meeting->selected_groups) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Meeting::GROUP as $id => $entry)
                                            <option value="{{ $id }}" {{ old('selected_groups', $meeting->selected_groups) === (string) $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('selected_groups'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('selected_groups') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.meeting.fields.attendees_helper') }}</span>
                                </div>
                                <div class="form-group" id="container_department_id">
                                    <label for="department_id">Department</label>
                                    <select class="form-control  {{ $errors->has('department_id') ? 'is-invalid' : '' }}" name="department_id" id="department_id" onchange="onSelectDept()">

                                        @foreach($department as $id => $entry)
                                            <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('department_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('department_id') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.meeting.fields.attendees_helper') }}</span>
                                </div>
                                <div class="form-group" id="container_affinity_group">
                                    <label for="affinity_group">Affinity Group</label>
                                    <select class="form-control  {{ $errors->has('affinity_group') ? 'is-invalid' : '' }}" name="affinity_group" id="affinity_group" onchange="onSelectAffinity_group()">
                                    <option value disabled {{ old('affinity_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Meeting::AFFINITY_GROUP as $id => $entry)
                                            <option value="{{ $id }}" {{ old('affinity_group') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('affinity_group'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('affinity_group') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.meeting.fields.attendees_helper') }}</span>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="attendees_id">Heads of department(HOD)</label>
                                    <select class="form-control  {{ $errors->has('attendees') ? 'is-invalid' : '' }}" name="attendees_id" id="attendees_id">
                                        @foreach($attendees as $id => $entry)
                                            <option value="{{ $id }}" {{ old('attendees_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attendees'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attendees') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.meeting.fields.attendees_helper') }}</span>
                                </div> -->
                            </div>
                            <!-- <div style="border-right: solid 1px #2eb85c; height:100%; width:1px;"></div> -->
                            <div class="col-8">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class=" table table-bordered table-striped table-hover datatable" id="memberTable">
                                            <thead>
                                                <tr>
                                                    <th width="10">

                                                    </th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="meeting_minutes">{{ trans('cruds.meeting.fields.meeting_minutes') }}</label>
                <div class="needsclick dropzone {{ $errors->has('meeting_minutes') ? 'is-invalid' : '' }}" id="meeting_minutes-dropzone">
                </div>
                @if($errors->has('meeting_minutes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_minutes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.meeting_minutes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.meeting.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.files_helper') }}</span>
            </div>
            <!-- <div class="form-group">
                <div class="form-check {{ $errors->has('processing') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="processing" value="0">
                    <input class="form-check-input" type="checkbox" name="processing" id="processing" value="1" {{ $meeting->processing || old('processing', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="processing">{{ trans('cruds.meeting.fields.processing') }}</label>
                </div>
                @if($errors->has('processing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('processing') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.processing_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $meeting->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">{{ trans('cruds.meeting.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.approved_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('disapproved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="disapproved" value="0">
                    <input class="form-check-input" type="checkbox" name="disapproved" id="disapproved" value="1" {{ $meeting->disapproved || old('disapproved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="disapproved">{{ trans('cruds.meeting.fields.disapproved') }}</label>
                </div>
                @if($errors->has('disapproved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disapproved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.disapproved_helper') }}</span>
            </div> -->

            <div class="form-group">
                    <label>{{ trans('cruds.joinDepartment.fields.approval_status') }}</label>
                    <select class="form-control {{ $errors->has('approval_status') ? 'is-invalid' : '' }}" name="approval_status" id="approval_status">
                        <option value disabled {{ old('approval_status', $meeting->approval_status) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\JoinDepartment::APPROVAL_STATUS as $key => $label)
                            @if($key != '3')
                                <option value="{{ $key }}" {{ old('approval_status', $meeting->approval_status) === (integer) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endif

                        @endforeach
                    </select>
                    @if($errors->has('approval_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('approval_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.joinDepartment.fields.primary_function_helper') }}</span>
                </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
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
                    <table class="table table-bordered table-striped table-hover datatable" id="memberListTable">
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


<div class="modal fade" id="dateListmodal" tabindex="-1" role="dialog" aria-labelledby="dateListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModal">Date list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="table-responsive" style="width: 100% !important">
                    <table class="table table-bordered table-striped table-hover datatable" id="dateListTable">
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
    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }
    Date.prototype.toDString = function() {
        var date = new Date(this.valueOf());

        return `${(date.getMonth()+1)<10?`0${date.getMonth()+1}`:date.getMonth()+1}-${(date.getDate())<10?`0${date.getDate()}`:date.getDate()}-${date.getFullYear()}`;
    }
</script>

<script>
    var uploadedMeetingMinutesMap = {}
Dropzone.options.meetingMinutesDropzone = {
    url: '{{ route('admin.meetings.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="meeting_minutes[]" value="' + response.name + '">')
      uploadedMeetingMinutesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedMeetingMinutesMap[file.name]
      }
      $('form').find('input[name="meeting_minutes[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($meeting) && $meeting->meeting_minutes)
          var files =
            {!! json_encode($meeting->meeting_minutes) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="meeting_minutes[]" value="' + file.file_name + '">')
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
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.meetings.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($meeting) && $meeting->files)
          var files =
            {!! json_encode($meeting->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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
    var table;
    var tableList;
    var selected_groups;
    var selectDataTabel = [];
    var dateList = [];
    var dateListTable;
    var optionType;
    function onSelectGroup(){
       selected_groups = $('#selected_groups').val();
        if(selected_groups === 'department'){
            document.getElementById('container_department_id').style.display='block';
            document.getElementById('container_affinity_group').style.display='none';
            $('#affinity_group').val(null);
            table.clear().draw();

        } else if(selected_groups === 'all' || selected_groups === 'hod'){
            document.getElementById('container_department_id').style.display='none';
            document.getElementById('container_affinity_group').style.display='none';
            $('#department_id').val(null);
            $('#affinity_group').val(null);
            table.clear().draw();
            if(selected_groups === 'all'){
                GetMemberList(selected_groups, null);
            }
        } else if(selected_groups === 'affinity_group'){
            document.getElementById('container_department_id').style.display='none';
            document.getElementById('container_affinity_group').style.display='block';
            $('#department_id').val(null);
            table.clear().draw();
        }
    }

    function  onSelectDept(){
        const department_id = $('#department_id').val();
        GetMemberList(selected_groups, department_id);
    }

    function  onSelectAffinity_group(){
        const affinity_group = $('#affinity_group').val();
        GetMemberList(selected_groups, affinity_group);
    }

    function GetMemberList(member_group_param, member_type_param){

        Get(`/admin/meetings/get_Member_list/${member_group_param}/${member_type_param}`, true).then(datares => {
            console.log(datares);

            selectDataTabel = [];
            selectDataTabel = datares;
            table.clear().draw();
            table.rows.add(selectDataTabel).draw();

        });

    }

    function DateListIntevalCalculation(){
       const start_date =   document.getElementById('start_date').value;
       if(start_date == null||start_date == undefined||start_date == '') return;
       const start_time =  $("#start_time").val();
       const year =   $("#year").val();
       const intervalstr =   $("#interval").val();
       if(intervalstr == null||intervalstr == undefined||intervalstr == '') return;
       let start =new Date(start_date);
       const end = new Date(`12/31/${year}`);
       const totalDaysLeft = DaysBetween(start, end);
       const interval = Number.parseInt(intervalstr);
       dateList = [];
       var pt = {
                                date: start.toDString(),
                                time: $('#start_time2').val(),
                                status: 'Not started'
                            }
       dateList.push(pt);
       for(var i = 1; i <= totalDaysLeft; i+=interval){
            start = start.addDays(interval);
            if(start.getFullYear() == year){
                var pt = {
                                date: start.toDString(),
                                time: $('#start_time2').val(),
                                status: 'Not started'
                            }
                dateList.push(pt);
            }

       }
       $('#end_date').val(dateList[dateList.length -1].date);
       document.getElementById('btnViewDate').style.display='block';
       buildJson();
    }

    function DateListSpecificCalculation(){
        const year =   $("#year").val();
        const specific_date = $('#specific_date').val();
        if(specific_date == null||specific_date == undefined||specific_date == '') return;
        let start =new Date()
        const end = new Date(`12/31/${year}`);
        const totalMonthLeft = (end.getMonth() + 1) - (start.getMonth() + 1);
        let month = (start.getMonth() + 1);
        dateList = [];
        if(start.getDate() < Number.parseInt(specific_date)){
            const dt = new Date(`${month}/${specific_date}/${year}`);
            var pt = {
                                date: dt.toDString(),
                                time: $('#start_time2').val(),
                                status: 'Not started'
                            }
            dateList.push(pt);
        }
        for(var i = 1; i <= totalMonthLeft; i++){
            month++;
            const dt = new Date(`${month}/${specific_date}/${year}`);
            var pt = {
                                date: dt.toDString(),
                                time: $('#start_time2').val(),
                                status: 'Not started'
                            }
            dateList.push(pt);
        }
        $('#end_date').val(dateList[dateList.length -1].date);
       document.getElementById('btnViewDate').style.display='block';
       buildJson();
    }

    function DateListfrequecyCalculation(){
        dateList = [];
        const year =   $("#year").val();
        const dayinaWeek = $('#dayinaWeek').val();

        if(dayinaWeek == null||dayinaWeek == undefined||dayinaWeek == '') return;

        const frequency = $('#frequency').val();
        if(frequency == null||frequency == undefined||frequency == '') return;

        let start =new Date()
        const end = new Date(`12/31/${year}`);

        const totalMonthLeft = (end.getMonth() + 1) - (start.getMonth() + 1);
        $.each(dayinaWeek, (index, dayinaWeekVal) => {
            const selecteddayinaWeek = Number.parseInt(dayinaWeekVal);
            start =new Date();
            for(var l = 0; l <= totalMonthLeft; l++){
                var daets = [];
                start.setDate(1);
                var dtWeek = start.getDay() ;

                while (dtWeek !== selecteddayinaWeek-1) {

                    start.setDate(start.getDate() + 1);
                    dtWeek = start.getDay();
                }
                var month = start.getMonth();

                const currentNumberfallInAWeek = getWeekOfMonth(start);
                if(selecteddayinaWeek -1 === start.getDay()){

                    var count  =0;
                    while (start.getMonth() === month) {

                        daets.push(new Date(start.getTime()));
                        start.setDate(start.getDate() + 7);
                        count= start.getDay();


                    }
                    $.each(frequency, (ind, vfr) => {
                        var frequencyInt = Number.parseInt(vfr);
                        if(daets[frequencyInt -1]> (new Date())){
                            var pt = {
                                date: daets[frequencyInt -1].toDString(),
                                time: $('#start_time2').val(),
                                status: 'Not started'
                            }
                            dateList.push(pt);
                        }
                    });


                }

            }
        });

        dateList = dateList.sort((a,b)=>((new Date(a.date)).getTime()-(new Date(b.date)).getTime()));
        $('#end_date').val(dateList[dateList.length -1].date);
       document.getElementById('btnViewDate').style.display='block';
       buildJson();
    }

    function getWeekOfMonth(date) {
        let adjustedDate = date.getDate()+ date.getDay();
        let prefixes = ['0', '1', '2', '3', '4', '5'];
        return (parseInt(prefixes[0 | adjustedDate / 7])+1);
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

    function onShowDateList(){
        $('#dateListmodal').on('shown.bs.modal', function () {
            console.log('Shown');


        });
        $('#dateListmodal').modal('show');
        dateListTable.clear().draw();
        dateListTable.rows.add(dateList).draw();

        setTimeout(function(){
            dateListTable.columns.adjust()

        },300);

    }

    function DaysBetween(StartDate, EndDate) {
        const oneDay = 1000 * 60 * 60 * 24;
        const start = Date.UTC(EndDate.getFullYear(), EndDate.getMonth(), EndDate.getDate());
        const end = Date.UTC(StartDate.getFullYear(), StartDate.getMonth(), StartDate.getDate());
        return (start - end) / oneDay;
    }

    function reoccurence(){
        const re_occur =document.getElementById('re_occurence').checked;
        if(re_occur){
            document.getElementById('container_re_occur').style.display='block';
            document.getElementById('once').style.display='none';
        } else {
            document.getElementById('container_re_occur').style.display='none';
            document.getElementById('once').style.display='block';
        }
    }
    function decompiledJson(){
        let t = JSON.parse($('#re_occurence_json').val());
        var isRecurrence = '{{$meeting->re_occurence}}';
        var optionTypeName = t.optionType=== 'frequency'?'optionType1':t.optionType=== 'specific'?'optionType2':'optionType3';
        onChangeoptionType(optionTypeName);
        reoccurence();
        document.getElementById('container_department_id').style.display='none';
        document.getElementById('container_affinity_group').style.display='none';

        $('#department_id').val(null);
        $('#affinity_group').val(null);

        if(isRecurrence == 1){

            document.getElementById(optionTypeName).checked = true;
            if(t.optionType === 'specific'){
                $('#specific_date').val(t.specific_date);
                $('#start_time2').val(t.start_time);
                $('#end_date').val(t.end_date);
                document.getElementById('btnViewDate').style.display='block';
                var sat = '{{$meeting->date_of_meeting}}'.replace(/&quot;/g,'"');
                dateList = JSON.parse(sat);
            }
            else if(t.optionType === 'frequency'){
                $('#frequency').val(t.frequency).trigger("change");
                $('#start_time2').val(t.start_time);
                $('#end_date').val(t.end_date);
                $('#dayinaWeek').val(t.dayinaWeek).trigger("change");
                document.getElementById('btnViewDate').style.display='block';
                var sat = '{{$meeting->date_of_meeting}}'.replace(/&quot;/g,'"');
                dateList = JSON.parse(sat);
            }
            else if(t.optionType === 'interval'){
                $('#start_time2').val(t.start_time);
                $('#end_date').val(t.end_date);
                $('#start_date').val(t.start_date);
                document.getElementById('btnViewDate').style.display='block';
                var sat = '{{$meeting->date_of_meeting}}'.replace(/&quot;/g,'"');
                dateList = JSON.parse(sat);
            }
        } else {
            $('#date_static').val(t.specific_date);
            $('#start_time').val(t.start_time);
        }

        selected_groups = '{{$meeting->selected_groups}}';

        onSelectGroup();

        if(selected_groups === 'department'){
            $('#department_id').val('{{$meeting->department_id}}')
            onSelectDept();
        } else if(selected_groups === 'affinity_group'){
            onSelectAffinity_group();
        }

    }
    function buildJson(){
        let t = {
            'optionType': optionType,
            'specific_date': $('#specific_date').val(),
            'start_time': $('#start_time2').val(),
            'interval': $('#interval').val(),
            'frequency': $('#frequency').val(),
            'end_date': $('#end_date').val(),
            'year' :   $("#year").val(),
            'dayinaWeek': $('#dayinaWeek').val(),
            'start_date': $('#start_date').val()
        };
        var isRecurrence =document.getElementById('re_occurence').checked;

        if(!isRecurrence){
            t.specific_date = $('#date_static').val();
            t.start_time = $('#start_time').val();
        }
        $('#re_occurence_json').val(JSON.stringify(t));
        dateList.forEach(element => {
            if($('#start_time2').val() === ''){
                element.time =$('#start_time').val();
            } else {
                element.time =$('#start_time2').val();
            }

        });

        $('#date_of_meeting').val(JSON.stringify(dateList));
        var ids = $.map(table.rows('.selected').data(), function (item) {
            return item.id
        });
        $('#attendees_id_list').val(JSON.stringify(ids));
    }
    function onStaticDate(){
        dateList = [];
        var pt = {
                    date: new Date($('#date_static').val()).toDString(),
                    time: $('#start_time').val(),
                    status: 'Not started'
                }
        dateList.push(pt);
        $('[name=date_of_meeting]').val(JSON.stringify(dateList));
        console.log($('#date_of_meeting').val());
    }
    function onChangeoptionType(name){
        optionType = $(`#${name}`).val();
        console.log(optionType);
        dateList = []; //date_of_meeting
        $('#specific_date').val(null);
        $('#start_time2').val(null);
        $('#interval').val(null);
        $('#frequency').val(null);
        $('#end_date').val(null);
        document.getElementById('specific_date').innerHTML = '';
        if(optionType === 'specific'){
            document.getElementById('container_start_date').style.display = 'none';
            document.getElementById('container_dayinaWeek').style.display = 'none';
            document.getElementById('container_interval').style.display = 'none';
            document.getElementById('container_frequency').style.display = 'none';

            document.getElementById('container_specific_date').style.display = 'block';
            document.getElementById('specific_date').innerHTML = '';
            $('#specific_date').append($('<option>', { value: '', text: '{{ trans('global.pleaseSelect') }}' }));
            for(var j =1; j <= 31; j++){
                $('#specific_date').append($('<option>', { value: j, text: j }));

            }
            document.getElementById('container_end_date').className = 'col-4 form-group'
        } else if(optionType === 'frequency'){
            document.getElementById('container_start_date').style.display = 'none';
            document.getElementById('container_dayinaWeek').style.display = 'block';
            document.getElementById('container_interval').style.display = 'none';
            document.getElementById('container_frequency').style.display = 'block';

            document.getElementById('container_specific_date').style.display = 'none';
            document.getElementById('container_end_date').className = 'col-2 form-group'
        }
        else if(optionType === 'interval'){
            document.getElementById('container_start_date').style.display = 'block';
            document.getElementById('container_dayinaWeek').style.display = 'none';
            document.getElementById('container_interval').style.display = 'block';
            document.getElementById('container_frequency').style.display = 'none';

            document.getElementById('container_specific_date').style.display = 'none';
            document.getElementById('container_end_date').className = 'col-3 form-group'
        }

    }



    $(document).ready(() => {

        var attendees_id_list = JSON.parse('{{$meeting->attendees_id_list}}');


        table =  $('#memberTable').DataTable(
            {
                destroy: true,
                data: [],
                dom: 'Bfrtip',
                select: true,
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                buttons: [
                    {extend:'selectAll', text: 'Select All' , className: 'btn-primary' },
                    {extend: 'selectNone', text: 'Deselect All', enabled: false, className: 'btn-primary'},
                    { text: 'Add More',
                        className: 'btn btn-outline-success',
                        action: function ( e, dt, node, config ) {
                           $('#addMoreModal').modal('show');
                           tableList =  $('#memberListTable').DataTable(
                            {
                                destroy: true,
                                processing: true,
                                serverSide: true,
                                ajax: "/admin/members/get_member_list",
                                buttons: [

                                ],
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

                            $('#addMoreModal tbody').on('dblclick', 'tr', function () {
                                var data = tableList.row(this).data();

                                const chk = selectDataTabel.find(k => k.email === data.email);
                                if(chk !== undefined){
                                    ErrorNotification(`Member ${chk.member_name} already exit in the list`);
                                    return;
                                }

                                selectDataTabel.push(data);
                                table.clear().draw();
                                table.rows.add(selectDataTabel).draw();
                                $('#addMoreModal').modal('hide');
                            });

                        }
                    }
                ],
                processing: true,

                columns: [
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        data: 'id',
                        defaultContent: '',
                        name: 'id',
                        render: function(data, type, full, meta) {
                            return '';
                        }
                    },
                    { data: 'member_name', name: 'member_name' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile', name: 'mobile' },
                ],
                rowCallback: function ( row, data, index ) {
                  var SelectVal = [];
                  if(attendees_id_list == null || attendees_id_list == undefined) return;
                  SelectVal = attendees_id_list;//JSON.parse($('#attendees_id_list').val());
                  var check = SelectVal.find(c => c == data.id);
                  if(check !== undefined && check !== null ) {
                    $(row).addClass('selected');
                  }
                  attendees_id_list = null;
                  buildJson();
               },

            });

            table.on( 'select', function ( e, dt, type, indexes ) {
                buildJson();
            });
            table.on( 'deselect', function ( e, dt, type, indexes ) {
                buildJson();
            });

            $('#start_date').datetimepicker({
                format: 'MM-DD-YYYY',
                locale: 'en',
                icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
                }
            });

            $('#date_static').datetimepicker({
                format: 'MM-DD-YYYY',
                locale: 'en',
                icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
                }
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
                                return `<span>${$('#start_time2').val()}</span>`;
                            }
                    },
                ]

            });

            $("#start_date").on("dp.change", function() {

                DateListIntevalCalculation();
            });
            $("#date_static").on("dp.change", function() {
                onStaticDate();
            });
            $("#start_time").on("dp.change", function() {
                onStaticDate();
            });

            decompiledJson();
    });
</script>

@endsection
