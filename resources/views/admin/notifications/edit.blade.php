@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.notification.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notifications.update", [$notification->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="message_title">{{ trans('cruds.notification.fields.message_title') }}</label>
                <input class="form-control {{ $errors->has('message_title') ? 'is-invalid' : '' }}" type="text" name="message_title" id="message_title" value="{{ old('message_title', $notification->message_title) }}">
                @if($errors->has('message_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.message_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.notification.fields.message') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{!! old('message', $notification->message) !!}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number_id">{{ trans('cruds.notification.fields.phone_number') }}</label>
                <select class="form-control select2 {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" name="phone_number_id" id="phone_number_id">
                    @foreach($phone_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('phone_number_id') ? old('phone_number_id') : $notification->phone_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="emails">{{ trans('cruds.notification.fields.email') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('emails') ? 'is-invalid' : '' }}" name="emails[]" id="emails" multiple>
                    @foreach($emails as $id => $email)
                        <option value="{{ $id }}" {{ (in_array($id, old('emails', [])) || $notification->emails->contains($id)) ? 'selected' : '' }}>{{ $email }}</option>
                    @endforeach
                </select>
                @if($errors->has('emails'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emails') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.notification.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $notification->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.date_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.notifications.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $notification->id ?? 0 }}');
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