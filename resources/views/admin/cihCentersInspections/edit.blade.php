@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cihCentersInspection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cih-centers-inspections.update", [$cihCentersInspection->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="date_of_inspection">{{ trans('cruds.cihCentersInspection.fields.date_of_inspection') }}</label>
                <input class="form-control date {{ $errors->has('date_of_inspection') ? 'is-invalid' : '' }}" type="text" name="date_of_inspection" id="date_of_inspection" value="{{ old('date_of_inspection', $cihCentersInspection->date_of_inspection) }}">
                @if($errors->has('date_of_inspection'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_inspection') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihCentersInspection.fields.date_of_inspection_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="center_visited_id">{{ trans('cruds.cihCentersInspection.fields.center_visited') }}</label>
                <select class="form-control select2 {{ $errors->has('center_visited') ? 'is-invalid' : '' }}" name="center_visited_id" id="center_visited_id">
                    @foreach($center_visiteds as $id => $entry)
                        <option value="{{ $id }}" {{ (old('center_visited_id') ? old('center_visited_id') : $cihCentersInspection->center_visited->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('center_visited'))
                    <div class="invalid-feedback">
                        {{ $errors->first('center_visited') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihCentersInspection.fields.center_visited_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="summary_of_visit">{{ trans('cruds.cihCentersInspection.fields.summary_of_visit') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('summary_of_visit') ? 'is-invalid' : '' }}" name="summary_of_visit" id="summary_of_visit">{!! old('summary_of_visit', $cihCentersInspection->summary_of_visit) !!}</textarea>
                @if($errors->has('summary_of_visit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('summary_of_visit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cihCentersInspection.fields.summary_of_visit_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.cih-centers-inspections.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $cihCentersInspection->id ?? 0 }}');
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