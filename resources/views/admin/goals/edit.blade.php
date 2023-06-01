@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.goal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.goals.update", [$goal->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.goal.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $goal->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal_name">{{ trans('cruds.goal.fields.goal_name') }}</label>
                <input class="form-control {{ $errors->has('goal_name') ? 'is-invalid' : '' }}" type="text" name="goal_name" id="goal_name" value="{{ old('goal_name', $goal->goal_name) }}">
                @if($errors->has('goal_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.goal_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.goal.fields.note') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{!! old('note', $goal->note) !!}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="achievement_date">{{ trans('cruds.goal.fields.achievement_date') }}</label>
                <input class="form-control date {{ $errors->has('achievement_date') ? 'is-invalid' : '' }}" type="text" name="achievement_date" id="achievement_date" value="{{ old('achievement_date', $goal->achievement_date) }}">
                @if($errors->has('achievement_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('achievement_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.achievement_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal_kpi">{{ trans('cruds.goal.fields.goal_kpi') }}</label>
                <input class="form-control {{ $errors->has('goal_kpi') ? 'is-invalid' : '' }}" type="text" name="goal_kpi" id="goal_kpi" value="{{ old('goal_kpi', $goal->goal_kpi) }}">
                @if($errors->has('goal_kpi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goal_kpi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.goal_kpi_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('open') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="open" value="0">
                    <input class="form-check-input" type="checkbox" name="open" id="open" value="1" {{ $goal->open || old('open', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="open">{{ trans('cruds.goal.fields.open') }}</label>
                </div>
                @if($errors->has('open'))
                    <div class="invalid-feedback">
                        {{ $errors->first('open') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.open_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('in_progress') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="in_progress" value="0">
                    <input class="form-check-input" type="checkbox" name="in_progress" id="in_progress" value="1" {{ $goal->in_progress || old('in_progress', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="in_progress">{{ trans('cruds.goal.fields.in_progress') }}</label>
                </div>
                @if($errors->has('in_progress'))
                    <div class="invalid-feedback">
                        {{ $errors->first('in_progress') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.in_progress_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('not_archieved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="not_archieved" value="0">
                    <input class="form-check-input" type="checkbox" name="not_archieved" id="not_archieved" value="1" {{ $goal->not_archieved || old('not_archieved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="not_archieved">{{ trans('cruds.goal.fields.not_archieved') }}</label>
                </div>
                @if($errors->has('not_archieved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('not_archieved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.not_archieved_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('closed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="closed" value="0">
                    <input class="form-check-input" type="checkbox" name="closed" id="closed" value="1" {{ $goal->closed || old('closed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="closed">{{ trans('cruds.goal.fields.closed') }}</label>
                </div>
                @if($errors->has('closed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('closed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.closed_helper') }}</span>
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