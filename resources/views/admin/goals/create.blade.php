@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.goal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.goals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.goal.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal_name">{{ trans('cruds.goal.fields.goal_name') }}</label>
                <input class="form-control {{ $errors->has('goal_name') ? 'is-invalid' : '' }}" type="text" name="goal_name" id="goal_name" value="{{ old('goal_name', '') }}">
                @if($errors->has('goal_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.goal_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.goal.fields.note') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{!! old('note') !!}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="achievement_date">{{ trans('cruds.goal.fields.achievement_date') }}</label>
                <input class="form-control date {{ $errors->has('achievement_date') ? 'is-invalid' : '' }}" type="text" name="achievement_date" id="achievement_date" value="{{ old('achievement_date') }}">
                @if($errors->has('achievement_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('achievement_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.achievement_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal_kpi">{{ trans('cruds.goal.fields.goal_kpi') }}</label>
                <input class="form-control {{ $errors->has('goal_kpi') ? 'is-invalid' : '' }}" type="text" name="goal_kpi" id="goal_kpi" value="{{ old('goal_kpi', '') }}">
                @if($errors->has('goal_kpi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal_kpi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.goal_kpi_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.goals.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $goal->id ?? 0 }}');
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