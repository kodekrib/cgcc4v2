@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.event.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $event->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.event.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $event->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $event->start_time) }}">
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
                <input class="form-control datetime {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $event->end_time) }}">
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expected_amount">{{ trans('cruds.event.fields.expected_amount') }}</label>
                <input class="form-control {{ $errors->has('expected_amount') ? 'is-invalid' : '' }}" type="number" name="expected_amount" id="expected_amount" value="{{ old('expected_amount', $event->expected_amount) }}" step="1">
                @if($errors->has('expected_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expected_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.expected_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_days">{{ trans('cruds.event.fields.no_of_days') }}</label>
                <input class="form-control {{ $errors->has('no_of_days') ? 'is-invalid' : '' }}" type="number" name="no_of_days" id="no_of_days" value="{{ old('no_of_days', $event->no_of_days) }}" step="1">
                @if($errors->has('no_of_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_of_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.no_of_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="accredited">{{ trans('cruds.event.fields.accredited') }}</label>
                <input class="form-control {{ $errors->has('accredited') ? 'is-invalid' : '' }}" type="number" name="accredited" id="accredited" value="{{ old('accredited', $event->accredited) }}" step="1">
                @if($errors->has('accredited'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accredited') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.accredited_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attendees_id">{{ trans('cruds.event.fields.attendees') }}</label>
                <select class="form-control select2 {{ $errors->has('attendees') ? 'is-invalid' : '' }}" name="attendees_id" id="attendees_id">
                    @foreach($attendees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('attendees_id') ? old('attendees_id') : $event->attendees->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('attendees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.attendees_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.event.fields.allow_overflow') }}</label>
                <select class="form-control {{ $errors->has('allow_overflow') ? 'is-invalid' : '' }}" name="allow_overflow" id="allow_overflow">
                    <option value disabled {{ old('allow_overflow', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Event::ALLOW_OVERFLOW_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('allow_overflow', $event->allow_overflow) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('allow_overflow'))
                    <div class="invalid-feedback">
                        {{ $errors->first('allow_overflow') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.allow_overflow_helper') }}</span>
            </div>
            <div class="form-group">
                    <label>{{ trans('cruds.event.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value disabled {{ old('status', $event->status) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Event::EVENTS_STATUS as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $event->status) === (integer) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.active_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.events.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $event->id ?? 0 }}');
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
