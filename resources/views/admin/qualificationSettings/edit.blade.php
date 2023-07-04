@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.qualificationSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qualification-settings.update", [$qualificationSetting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="highest_qualification">{{ trans('cruds.qualificationSetting.fields.highest_qualification') }}</label>
                <input class="form-control {{ $errors->has('highest_qualification') ? 'is-invalid' : '' }}" type="text" name="highest_qualification" id="highest_qualification" value="{{ old('highest_qualification', $qualificationSetting->highest_qualification) }}" required>
                @if($errors->has('highest_qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('highest_qualification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qualificationSetting.fields.highest_qualification_helper') }}</span>
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