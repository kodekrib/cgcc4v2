@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.mountainsOfInfluence.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mountains-of-influences.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nation">{{ trans('cruds.mountainsOfInfluence.fields.nation') }}</label>
                <input class="form-control {{ $errors->has('nation') ? 'is-invalid' : '' }}" type="text" name="nation" id="nation" value="{{ old('nation', '') }}" required>
                @if($errors->has('nation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.nation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="corresponding_mountain">{{ trans('cruds.mountainsOfInfluence.fields.corresponding_mountain') }}</label>
                <input class="form-control {{ $errors->has('corresponding_mountain') ? 'is-invalid' : '' }}" type="text" name="corresponding_mountain" id="corresponding_mountain" value="{{ old('corresponding_mountain', '') }}" required>
                @if($errors->has('corresponding_mountain'))
                    <div class="invalid-feedback">
                        {{ $errors->first('corresponding_mountain') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.corresponding_mountain_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prevailing_culture">{{ trans('cruds.mountainsOfInfluence.fields.prevailing_culture') }}</label>
                <input class="form-control {{ $errors->has('prevailing_culture') ? 'is-invalid' : '' }}" type="text" name="prevailing_culture" id="prevailing_culture" value="{{ old('prevailing_culture', '') }}" required>
                @if($errors->has('prevailing_culture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prevailing_culture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.prevailing_culture_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="counter_culture">{{ trans('cruds.mountainsOfInfluence.fields.counter_culture') }}</label>
                <input class="form-control {{ $errors->has('counter_culture') ? 'is-invalid' : '' }}" type="text" name="counter_culture" id="counter_culture" value="{{ old('counter_culture', '') }}" required>
                @if($errors->has('counter_culture'))
                    <div class="invalid-feedback">
                        {{ $errors->first('counter_culture') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.counter_culture_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="counter_culture_text">{{ trans('cruds.mountainsOfInfluence.fields.counter_culture_text') }}</label>
                <input class="form-control {{ $errors->has('counter_culture_text') ? 'is-invalid' : '' }}" type="text" name="counter_culture_text" id="counter_culture_text" value="{{ old('counter_culture_text', '') }}" required>
                @if($errors->has('counter_culture_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('counter_culture_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.counter_culture_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="attributes_of_christ">{{ trans('cruds.mountainsOfInfluence.fields.attributes_of_christ') }}</label>
                <input class="form-control {{ $errors->has('attributes_of_christ') ? 'is-invalid' : '' }}" type="text" name="attributes_of_christ" id="attributes_of_christ" value="{{ old('attributes_of_christ', '') }}" required>
                @if($errors->has('attributes_of_christ'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attributes_of_christ') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.attributes_of_christ_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="motivational_gifts">{{ trans('cruds.mountainsOfInfluence.fields.motivational_gifts') }}</label>
                <input class="form-control {{ $errors->has('motivational_gifts') ? 'is-invalid' : '' }}" type="text" name="motivational_gifts" id="motivational_gifts" value="{{ old('motivational_gifts', '') }}" required>
                @if($errors->has('motivational_gifts'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motivational_gifts') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.motivational_gifts_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mountain_leader_id">{{ trans('cruds.mountainsOfInfluence.fields.mountain_leader') }}</label>
                <select class="form-control select2 {{ $errors->has('mountain_leader') ? 'is-invalid' : '' }}" name="mountain_leader_id" id="mountain_leader_id" required>
                    @foreach($mountain_leaders as $id => $entry)
                        <option value="{{ $id }}" {{ old('mountain_leader_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mountain_leader'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mountain_leader') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mountainsOfInfluence.fields.mountain_leader_helper') }}</span>
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