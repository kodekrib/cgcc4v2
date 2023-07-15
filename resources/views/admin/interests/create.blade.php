@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.interest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.interests.store") }}" enctype="multipart/form-data">
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

=======
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
            <div class="form-group">
                <label for="interests">{{ trans('cruds.interest.fields.interests') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('interests') ? 'is-invalid' : '' }}" name="interests[]" id="interests" multiple>
                    @foreach($interests as $id => $interest)
                        <option value="{{ $id }}" {{ in_array($id, old('interests', [])) ? 'selected' : '' }}>{{ $interest }}</option>
                    @endforeach
                </select>
                @if($errors->has('interests'))
                    <div class="invalid-feedback">
                        {{ $errors->first('interests') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interest.fields.interests_helper') }}</span>
            </div>
<<<<<<< HEAD
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="other_sports">{{ trans('cruds.interest.fields.other_sports') }}</label>
                    <input class="form-control {{ $errors->has('other_sports') ? 'is-invalid' : '' }}" type="text" name="other_sports" id="other_sports" value="{{ old('other_sports', '') }}">
                    @if($errors->has('other_sports'))
                        <div class="invalid-feedback">
                            {{ $errors->first('other_sports') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.interest.fields.other_sports_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="social_causes">{{ trans('cruds.interest.fields.social_causes') }}</label>
                    <input class="form-control {{ $errors->has('social_causes') ? 'is-invalid' : '' }}" type="text" name="social_causes" id="social_causes" value="{{ old('social_causes', '') }}">
                    @if($errors->has('social_causes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('social_causes') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.interest.fields.social_causes_helper') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="entrepreneurial_interests">{{ trans('cruds.interest.fields.entrepreneurial_interests') }}</label>
                    <input class="form-control {{ $errors->has('entrepreneurial_interests') ? 'is-invalid' : '' }}" type="text" name="entrepreneurial_interests" id="entrepreneurial_interests" value="{{ old('entrepreneurial_interests', '') }}">
                    @if($errors->has('entrepreneurial_interests'))
                        <div class="invalid-feedback">
                            {{ $errors->first('entrepreneurial_interests') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.interest.fields.entrepreneurial_interests_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="industry_sector_id">{{ trans('cruds.interest.fields.industry_sector') }}</label>
                    <select class="form-control select2 {{ $errors->has('industry_sector') ? 'is-invalid' : '' }}" name="industry_sector_id" id="industry_sector_id">
                        @foreach($industry_sectors as $id => $entry)
                            <option value="{{ $id }}" {{ old('industry_sector_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('industry_sector'))
                        <div class="invalid-feedback">
                            {{ $errors->first('industry_sector') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.interest.fields.industry_sector_helper') }}</span>
                </div>
=======
            <div class="form-group">
                <label for="other_sports">{{ trans('cruds.interest.fields.other_sports') }}</label>
                <input class="form-control {{ $errors->has('other_sports') ? 'is-invalid' : '' }}" type="text" name="other_sports" id="other_sports" value="{{ old('other_sports', '') }}">
                @if($errors->has('other_sports'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other_sports') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interest.fields.other_sports_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_causes">{{ trans('cruds.interest.fields.social_causes') }}</label>
                <input class="form-control {{ $errors->has('social_causes') ? 'is-invalid' : '' }}" type="text" name="social_causes" id="social_causes" value="{{ old('social_causes', '') }}">
                @if($errors->has('social_causes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('social_causes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interest.fields.social_causes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="entrepreneurial_interests">{{ trans('cruds.interest.fields.entrepreneurial_interests') }}</label>
                <input class="form-control {{ $errors->has('entrepreneurial_interests') ? 'is-invalid' : '' }}" type="text" name="entrepreneurial_interests" id="entrepreneurial_interests" value="{{ old('entrepreneurial_interests', '') }}">
                @if($errors->has('entrepreneurial_interests'))
                    <div class="invalid-feedback">
                        {{ $errors->first('entrepreneurial_interests') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interest.fields.entrepreneurial_interests_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="industry_sector_id">{{ trans('cruds.interest.fields.industry_sector') }}</label>
                <select class="form-control select2 {{ $errors->has('industry_sector') ? 'is-invalid' : '' }}" name="industry_sector_id" id="industry_sector_id">
                    @foreach($industry_sectors as $id => $entry)
                        <option value="{{ $id }}" {{ old('industry_sector_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('industry_sector'))
                    <div class="invalid-feedback">
                        {{ $errors->first('industry_sector') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.interest.fields.industry_sector_helper') }}</span>
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
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