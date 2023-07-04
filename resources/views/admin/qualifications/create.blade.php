@extends('layouts.admin')
@section('content')

<<<<<<< HEAD
{{-- <style>
    .form-group {
        margin-top: 20px; /* Adjust the value as needed */
    }
</style> --}}

=======
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.qualification.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qualifications.store") }}" enctype="multipart/form-data">
            @csrf
<<<<<<< HEAD
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="highest_qualifications_id">{{ trans('cruds.qualification.fields.highest_qualifications') }}</label>
                        <select class="form-control select2 {{ $errors->has('highest_qualifications') ? 'is-invalid' : '' }}" name="highest_qualifications_id" id="highest_qualifications_id" required>
                            @foreach($highest_qualifications as $id => $entry)
                                <option value="{{ $id }}" {{ old('highest_qualifications_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('highest_qualifications'))
                            <div class="invalid-feedback">
                                {{ $errors->first('highest_qualifications') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.qualification.fields.highest_qualifications_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="professional_qualification">{{ trans('cruds.qualification.fields.professional_qualification') }}</label>
                        <input class="form-control {{ $errors->has('professional_qualification') ? 'is-invalid' : '' }}" type="text" name="professional_qualification" id="professional_qualification" value="{{ old('professional_qualification', '') }}">
                        @if($errors->has('professional_qualification'))
                            <div class="invalid-feedback">
                                {{ $errors->first('professional_qualification') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.qualification.fields.professional_qualification_helper') }}</span>
                    </div>
                </div>
=======
            <div class="form-group">
                <label class="required" for="highest_qualifications_id">{{ trans('cruds.qualification.fields.highest_qualifications') }}</label>
                <select class="form-control select2 {{ $errors->has('highest_qualifications') ? 'is-invalid' : '' }}" name="highest_qualifications_id" id="highest_qualifications_id" required>
                    @foreach($highest_qualifications as $id => $entry)
                        <option value="{{ $id }}" {{ old('highest_qualifications_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('highest_qualifications'))
                    <div class="invalid-feedback">
                        {{ $errors->first('highest_qualifications') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.highest_qualifications_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="professional_qualification">{{ trans('cruds.qualification.fields.professional_qualification') }}</label>
                <input class="form-control {{ $errors->has('professional_qualification') ? 'is-invalid' : '' }}" type="text" name="professional_qualification" id="professional_qualification" value="{{ old('professional_qualification', '') }}">
                @if($errors->has('professional_qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('professional_qualification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.professional_qualification_helper') }}</span>
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
<<<<<<< HEAD
    
=======
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
</div>



@endsection