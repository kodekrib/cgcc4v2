@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointmentBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointment-bookings.update", [$appointmentBooking->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="member_name">{{ trans('cruds.appointmentBooking.fields.member_name') }}</label>
                <input class="form-control {{ $errors->has('member_name') ? 'is-invalid' : '' }}" type="text" name="member_name" id="member_name" value="{{ old('member_name', $appointmentBooking->member_name) }}">
                @if($errors->has('member_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.member_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="appointment_type_id">{{ trans('cruds.appointmentBooking.fields.appointment_type') }}</label>
                <select class="form-control select2 {{ $errors->has('appointment_type') ? 'is-invalid' : '' }}" name="appointment_type_id" id="appointment_type_id" disabled>
                    @foreach($appointment_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('appointment_type_id') ? old('appointment_type_id') : $appointmentBooking->appointment_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('appointment_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.appointment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appointment_date">{{ trans('cruds.appointmentBooking.fields.appointment_date') }}</label>
                <input class="form-control date {{ $errors->has('appointment_date') ? 'is-invalid' : '' }}" type="text" name="appointment_date" id="appointment_date" value="{{ old('appointment_date', $appointmentBooking->appointment_date) }}" required>
                @if($errors->has('appointment_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.appointment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appointment_time">{{ trans('cruds.appointmentBooking.fields.appointment_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('appointment_time') ? 'is-invalid' : '' }}" type="text" name="appointment_time" id="appointment_time" value="{{ old('appointment_time', $appointmentBooking->appointment_time) }}" required>
                @if($errors->has('appointment_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.appointment_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="purpose">{{ trans('cruds.appointmentBooking.fields.purpose') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('purpose') ? 'is-invalid' : '' }}" name="purpose" id="purpose">{!! old('purpose', $appointmentBooking->purpose) !!}</textarea>
                @if($errors->has('purpose'))
                    <div class="invalid-feedback">
                        {{ $errors->first('purpose') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.purpose_helper') }}</span>
            </div>

            <div class="form-group">
                    <label>{{ trans('cruds.joinDepartment.fields.approval_status') }}</label>
                    <select class="form-control {{ $errors->has('approved_status') ? 'is-invalid' : '' }}" name="approved_status" id="approved_status">
                        <option value disabled {{ old('approved_status', $appointmentBooking->approved_status) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\AppointmentBooking::APPROVAL_STATUS as $key => $label)

                            <option value="{{ $key }}" {{ old('approved_status', $appointmentBooking->approved_status) === (integer) $key ? 'selected' : '' }}>{{ $label }}</option>


                        @endforeach
                    </select>
                    @if($errors->has('approved_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('approved_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.joinDepartment.fields.primary_function_helper') }}</span>
            </div>
            <!-- <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $appointmentBooking->approved || old('approved', 0) === 1 ? 'checked' : '' }} onchange="ApprovalCheck('approved')">
                    <label class="form-check-label" for="approved">{{ trans('cruds.appointmentBooking.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.approved_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('disapproved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="disapproved" value="0">
                    <input class="form-check-input" type="checkbox" name="disapproved" id="disapproved" value="1" {{ $appointmentBooking->disapproved || old('disapproved', 0) === 1 ? 'checked' : '' }} onchange="ApprovalCheck('disapproved')">
                    <label class="form-check-label" for="disapproved">{{ trans('cruds.appointmentBooking.fields.disapproved') }}</label>
                </div>
                @if($errors->has('disapproved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disapproved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.disapproved_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('opened') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="opened" value="0">
                    <input class="form-check-input" type="checkbox" name="opened" id="opened" value="1" {{ $appointmentBooking->opened || old('opened', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="opened">{{ trans('cruds.appointmentBooking.fields.opened') }}</label>
                </div>
                @if($errors->has('opened'))
                    <div class="invalid-feedback">
                        {{ $errors->first('opened') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.opened_helper') }}</span>
            </div> -->
            <div class="form-group">
                <div class="form-check {{ $errors->has('re_assigned') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="re_assigned" value="0">
                    <input class="form-check-input" type="checkbox" name="re_assigned" id="re_assigned" value="1" {{ $appointmentBooking->re_assigned || old('re_assigned', 0) === 1 ? 'checked' : '' }} onchange='reassign()'>
                    <label class="form-check-label" for="re_assigned">{{ trans('cruds.appointmentBooking.fields.re_assigned') }}</label>
                </div>
                @if($errors->has('re_assigned'))
                    <div class="invalid-feedback">
                        {{ $errors->first('re_assigned') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.re_assigned_helper') }}</span>
            </div>
            <div class="form-group" id="container_assigned_to">
                <label for="assigned_to_id">{{ trans('cruds.appointmentBooking.fields.assigned_to') }}</label>
                <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                    @foreach($assigned_tos as $id => $entry)
                        <option value="{{ $entry->id }}" {{ (old('assigned_to_id') ? old('assigned_to_id') : $appointmentBooking->assigned_to->id ?? '') == $entry->id ? 'selected' : '' }}>{{ $entry->member_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('assigned_to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assigned_to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.assigned_to_helper') }}</span>
            </div>
            <!-- <div class="form-group">
                <div class="form-check {{ $errors->has('in_progress') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="in_progress" value="0">
                    <input class="form-check-input" type="checkbox" name="in_progress" id="in_progress" value="1" {{ $appointmentBooking->in_progress || old('in_progress', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="in_progress">{{ trans('cruds.appointmentBooking.fields.in_progress') }}</label>
                </div>
                @if($errors->has('in_progress'))
                    <div class="invalid-feedback">
                        {{ $errors->first('in_progress') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.in_progress_helper') }}</span>
            </div> -->
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
    function reassign(){
        if(document.getElementById('re_assigned').checked == true){
            document.getElementById('container_assigned_to').style.display ='block';
            $('[name=re_assigned]').val(1);
        } else {
            document.getElementById('container_assigned_to').style.display ='none';
            $('[name=re_assigned]').val(0);
            $('#assigned_to_id').val('');
        }
    }
    $(document).ready(function () {
        reassign();
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.appointment-bookings.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $appointmentBooking->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});

function ApprovalCheck(arg){

    if(arg == 'approved'){
        document.getElementById('disapproved').checked=false;
        $('[name=approved]').val(1); re_assigned
        $('[name=in_progress]').val(1);
        $('[name=disapproved]').val(0);

    } else if(arg == 'disapproved'){
        document.getElementById('approved').checked  = false;
        $('[name=approved]').val(0);
        $('[name=in_progress]').val(0);
        $('[name=disapproved]').val(1);
    }

}
</script>

@endsection
