@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.firstTimer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.first-timers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="service">{{ trans('cruds.firstTimer.fields.service') }}</label>
                <input class="form-control date {{ $errors->has('service') ? 'is-invalid' : '' }}" type="text" name="service" id="service" value="{{ old('service') }}">
                @if($errors->has('service'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="surname">{{ trans('cruds.firstTimer.fields.surname') }}</label>
                <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', '') }}">
                @if($errors->has('surname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('surname') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.surname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_name">{{ trans('cruds.firstTimer.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}">
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.firstTimer.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_birth">{{ trans('cruds.firstTimer.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marital_status_id">{{ trans('cruds.firstTimer.fields.marital_status') }}</label>
                <select class="form-control select2 {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status_id" id="marital_status_id">
                    @foreach($marital_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('marital_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marital_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marital_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.marital_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="occupation">{{ trans('cruds.firstTimer.fields.occupation') }}</label>
                <input class="form-control {{ $errors->has('occupation') ? 'is-invalid' : '' }}" type="text" name="occupation" id="occupation" value="{{ old('occupation', '') }}">
                @if($errors->has('occupation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('occupation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.occupation_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.firstTimer.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FirstTimer::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number">{{ trans('cruds.firstTimer.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.firstTimer.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="residential_address">{{ trans('cruds.firstTimer.fields.residential_address') }}</label>
                <textarea class="form-control {{ $errors->has('residential_address') ? 'is-invalid' : '' }}" name="residential_address" id="residential_address">{{ old('residential_address') }}</textarea>
                @if($errors->has('residential_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('residential_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.residential_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nearest_bus_stop">{{ trans('cruds.firstTimer.fields.nearest_bus_stop') }}</label>
                <input class="form-control {{ $errors->has('nearest_bus_stop') ? 'is-invalid' : '' }}" type="text" name="nearest_bus_stop" id="nearest_bus_stop" value="{{ old('nearest_bus_stop', '') }}">
                @if($errors->has('nearest_bus_stop'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nearest_bus_stop') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.nearest_bus_stop_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.firstTimer.fields.country') }}</label>
                <select class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality" id="nationality" onchange="changeCountry()">
                    <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach ($countries as $country => $data)
                    <option value="{{ $data['name'] }}" {{ old('country_of_birth', '') === (string) $data['name'] ? 'selected' : '' }}>{{ $data['name']}}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.firstTimer.fields.state') }}</label>

                <select class="form-control {{ $errors->has('state_of_origin') ? 'is-invalid' : '' }}" name="state_of_origin" >
                    <option value disabled {{ old('state_of_origin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach ($states as $state => $label)
                        <option value="{{ $label['state'] }}" {{ old('state_of_origin', '') === (string) $label['state'] ? 'selected' : '' }}>{{ $label['state'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.firstTimer.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                {{-- <select class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city" id="city">
                    <option value disabled {{ old('city', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FirstTimer::CITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('city', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select> --}}
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.firstTimer.fields.join_cgcc') }}</label>
                <select class="form-control {{ $errors->has('join_cgcc') ? 'is-invalid' : '' }}" name="join_cgcc" id="join_cgcc">
                    <option value disabled {{ old('join_cgcc', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FirstTimer::JOIN_CGCC_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('join_cgcc', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('join_cgcc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('join_cgcc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.join_cgcc_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.firstTimer.fields.start_ats') }}</label>
                <select class="form-control {{ $errors->has('start_ats') ? 'is-invalid' : '' }}" name="start_ats" id="start_ats">
                    <option value disabled {{ old('start_ats', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FirstTimer::START_ATS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('start_ats', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('start_ats'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_ats') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.start_ats_helper') }}</span>
            </div>
            <div class="form-group">
                <label>ATS Mode</label>
                <select class="form-control {{ $errors->has('ats_mode') ? 'is-invalid' : '' }}" name="ats_mode" id="ats_mode">
                    <option value disabled {{ old('ats_mode', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FirstTimer::ATS_MODE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('ats_mode', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('ats_mode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ats_mode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.ats_mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prayer_request">{{ trans('cruds.firstTimer.fields.prayer_request') }}</label>
                <textarea class="form-control {{ $errors->has('prayer_request') ? 'is-invalid' : '' }}" name="prayer_request" id="prayer_request">{{ old('prayer_request') }}</textarea>
                @if($errors->has('prayer_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prayer_request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.firstTimer.fields.prayer_request_helper') }}</span>
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