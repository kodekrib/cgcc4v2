@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointmentBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointment-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="member_name">{{ trans('cruds.appointmentBooking.fields.member_name') }}</label>
                <input class="form-control {{ $errors->has('member_name') ? 'is-invalid' : '' }}" type="text" name="member_name" id="member_name" value="{{{ Auth::user()->name }}} {{{ Auth::user()->firstname }}}" readonly required>
                @if($errors->has('member_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.member_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="appointment_type_id">{{ trans('cruds.appointmentBooking.fields.appointment_type') }}</label>
                <select class="form-control select2 {{ $errors->has('appointment_type') ? 'is-invalid' : '' }}" name="appointment_type_id" id="appointment_type_id">
                    @foreach($appointment_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('appointment_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control date {{ $errors->has('appointment_date') ? 'is-invalid' : '' }}" type="text" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required>
                @if($errors->has('appointment_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.appointment_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appointment_time">{{ trans('cruds.appointmentBooking.fields.appointment_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('appointment_time') ? 'is-invalid' : '' }}" type="text" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}" required>
                @if($errors->has('appointment_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.appointment_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="purpose">{{ trans('cruds.appointmentBooking.fields.purpose') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('purpose') ? 'is-invalid' : '' }}" name="purpose" id="purpose">{!! old('purpose') !!}</textarea>
                @if($errors->has('purpose'))
                    <div class="invalid-feedback">
                        {{ $errors->first('purpose') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentBooking.fields.purpose_helper') }}</span>
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
    $(document).ready(function () {
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
</script>

@endsection