@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.attendanceManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendance-managements.update", [$attendanceManagement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="meeting_type_id">{{ trans('cruds.attendanceManagement.fields.meeting_type') }}</label>
                <select class="form-control select2 {{ $errors->has('meeting_type') ? 'is-invalid' : '' }}" name="meeting_type_id" id="meeting_type_id">
                    @foreach($meeting_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('meeting_type_id') ? old('meeting_type_id') : $attendanceManagement->meeting_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('meeting_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.meeting_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="meeting_title_id">{{ trans('cruds.attendanceManagement.fields.meeting_title') }}</label>
                <select class="form-control select2 {{ $errors->has('meeting_title') ? 'is-invalid' : '' }}" name="meeting_title_id" id="meeting_title_id">
                    @foreach($meeting_titles as $id => $entry)
                        <option value="{{ $id }}" {{ (old('meeting_title_id') ? old('meeting_title_id') : $attendanceManagement->meeting_title->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <label for="date">{{ trans('cruds.attendanceManagement.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $attendanceManagement->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="summary_report">{{ trans('cruds.attendanceManagement.fields.summary_report') }}</label>
                <textarea class="form-control {{ $errors->has('summary_report') ? 'is-invalid' : '' }}" name="summary_report" id="summary_report">{{ old('summary_report', $attendanceManagement->summary_report) }}</textarea>
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
                <select class="form-control select2 {{ $errors->has('members_in_attendances') ? 'is-invalid' : '' }}" name="members_in_attendances[]" id="members_in_attendances" multiple required>

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
                        <option value="{{ $key }}" {{ old('age_category', $attendanceManagement->age_category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                        <option value="{{ $key }}" {{ old('gender_category', $attendanceManagement->gender_category) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <input class="form-control {{ $errors->has('state_of_the_flock') ? 'is-invalid' : '' }}" type="email" name="state_of_the_flock" id="state_of_the_flock" value="{{ old('state_of_the_flock', $attendanceManagement->state_of_the_flock) }}">
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
                        <option value="{{ $id }}" {{ (old('cih_centre_id') ? old('cih_centre_id') : $attendanceManagement->cih_centre->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <div class="form-check {{ $errors->has('present') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="present" value="0">
                    <input class="form-check-input" type="checkbox" name="present" id="present" value="1" {{ $attendanceManagement->present || old('present', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="present">{{ trans('cruds.attendanceManagement.fields.present') }}</label>
                </div>
                @if($errors->has('present'))
                    <div class="invalid-feedback">
                        {{ $errors->first('present') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.present_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('absent') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="absent" value="0">
                    <input class="form-check-input" type="checkbox" name="absent" id="absent" value="1" {{ $attendanceManagement->absent || old('absent', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="absent">{{ trans('cruds.attendanceManagement.fields.absent') }}</label>
                </div>
                @if($errors->has('absent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('absent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.absent_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('excused') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="excused" value="0">
                    <input class="form-check-input" type="checkbox" name="excused" id="excused" value="1" {{ $attendanceManagement->excused || old('excused', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="excused">{{ trans('cruds.attendanceManagement.fields.excused') }}</label>
                </div>
                @if($errors->has('excused'))
                    <div class="invalid-feedback">
                        {{ $errors->first('excused') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendanceManagement.fields.excused_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
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
@endsection
