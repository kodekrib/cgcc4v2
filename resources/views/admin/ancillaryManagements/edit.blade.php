@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ancillaryManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ancillary-managements.update", [$ancillaryManagement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.ancillaryManagement.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $ancillaryManagement->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ancillaryManagement.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_type_id">{{ trans('cruds.ancillaryManagement.fields.service_type') }}</label>
                <select class="form-control select2 {{ $errors->has('service_type') ? 'is-invalid' : '' }}" name="service_type_id" id="service_type_id">
                    @foreach($service_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('service_type_id') ? old('service_type_id') : $ancillaryManagement->service_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('service_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ancillaryManagement.fields.service_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_description">{{ trans('cruds.ancillaryManagement.fields.service_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('service_description') ? 'is-invalid' : '' }}" name="service_description" id="service_description">{!! old('service_description', $ancillaryManagement->service_description) !!}</textarea>
                @if($errors->has('service_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ancillaryManagement.fields.service_description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('approve') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approve" value="0">
                    <input class="form-check-input" type="checkbox" name="approve" id="approve" value="1" {{ $ancillaryManagement->approve || old('approve', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approve">{{ trans('cruds.ancillaryManagement.fields.approve') }}</label>
                </div>
                @if($errors->has('approve'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approve') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ancillaryManagement.fields.approve_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('decline') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="decline" value="0">
                    <input class="form-check-input" type="checkbox" name="decline" id="decline" value="1" {{ $ancillaryManagement->decline || old('decline', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="decline">{{ trans('cruds.ancillaryManagement.fields.decline') }}</label>
                </div>
                @if($errors->has('decline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('decline') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ancillaryManagement.fields.decline_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.ancillary-managements.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $ancillaryManagement->id ?? 0 }}');
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