@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.mailing.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mailings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.mailing.fields.job_mailing_list') }}</label>
                <select class="form-control {{ $errors->has('job_mailing_list') ? 'is-invalid' : '' }}" name="job_mailing_list" id="job_mailing_list" onchange="onSelectJobMailingList()">
                    <option value disabled {{ old('job_mailing_list', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Mailing::JOB_MAILING_LIST_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('job_mailing_list', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_mailing_list'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_mailing_list') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailing.fields.job_mailing_list_helper') }}</span>
            </div>
            <div class="form-group" id="container_area_of_specialization_id">
                <label for="area_of_specialization_id">{{ trans('cruds.mailing.fields.area_of_specialization') }}</label>
                <select class="form-control select2 {{ $errors->has('area_of_specialization') ? 'is-invalid' : '' }}" name="area_of_specialization_id" id="area_of_specialization_id">
                    @foreach($area_of_specializations as $id => $entry)
                        <option value="{{ $id }}" {{ old('area_of_specialization_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('area_of_specialization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_of_specialization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailing.fields.area_of_specialization_helper') }}</span>
            </div>
            <div class="form-group" id="conatiner_job_level_id">
                <label for="job_level_id">{{ trans('cruds.mailing.fields.job_level') }}</label>
                <select class="form-control select2 {{ $errors->has('job_level') ? 'is-invalid' : '' }}" name="job_level_id" id="job_level_id">
                    @foreach($job_levels as $id => $entry)
                        <option value="{{ $id }}" {{ old('job_level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailing.fields.job_level_helper') }}</span>
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
        function onSelectJobMailingList(){
            const opt = $('#job_mailing_list').val();

            if(opt == 'yes'){
                document.getElementById('container_area_of_specialization_id').style.display = 'block';
                document.getElementById('conatiner_job_level_id').style.display = 'block';
            } else {
                document.getElementById('container_area_of_specialization_id').style.display = 'none';
                document.getElementById('conatiner_job_level_id').style.display = 'none';
                $('#area_of_specialization_id').val('');
                $('#job_level_id').val('');
            }
        }

        $(document ).ready(() =>{
            document.getElementById('container_area_of_specialization_id').style.display = 'none';
                document.getElementById('conatiner_job_level_id').style.display = 'none';
        });
  </script>
@endsection
