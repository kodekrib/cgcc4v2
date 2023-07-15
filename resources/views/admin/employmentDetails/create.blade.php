@extends('layouts.admin')
<<<<<<< HEAD

@section('content')

<style>
    .form-group {
        margin-top: 20px; /* Adjust the value as needed */
    }
</style>

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.employmentDetail.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.employment-details.store') }}" enctype="multipart/form-data">
                @csrf
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
                            <label class="required" for="employer_name">{{ trans('cruds.employmentDetail.fields.employer_name') }}</label>
                            <input class="form-control {{ $errors->has('employer_name') ? 'is-invalid' : '' }}" type="text" name="employer_name" id="employer_name" value="{{ old('employer_name', '') }}" required>
                            @if($errors->has('employer_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employer_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.employer_name_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="employer_address">{{ trans('cruds.employmentDetail.fields.employer_address') }}</label>
                            <input class="form-control {{ $errors->has('employer_address') ? 'is-invalid' : '' }}" type="text" name="employer_address" id="employer_address" value="{{ old('employer_address', '') }}">
                            @if($errors->has('employer_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employer_address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.employer_address_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="employer_address_2">{{ trans('cruds.employmentDetail.fields.employer_address_2') }}</label>
                            <input class="form-control {{ $errors->has('employer_address_2') ? 'is-invalid' : '' }}" type="text" name="employer_address_2" id="employer_address_2" value="{{ old('employer_address_2', '') }}">
                            @if($errors->has('employer_address_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employer_address_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.employer_address_2_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('cruds.employmentDetail.fields.country') }}</label>
                            <select class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country" onchange="changeCountry()">
                                <option value disabled {{ old('country', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach($countries as $country => $data)
                                    <option value="{{ $data['name']  }}" {{ old('country', '') === (string)$data['name'] ? 'selected' : '' }}>{{ $data['name']  }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.country_helper') }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" id="state_dropDown">
                            <label>{{ trans('cruds.employmentDetail.fields.state') }}</label>
                            <select class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state" id="state">
                                <option value disabled {{ old('state', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach($states as $state => $label)
                                    <option value="{{ $label['state'] }}" {{ old('state', '') === (string) $label['state'] ? 'selected' : '' }}>{{ $label['state'] }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.state_helper') }}</span>
                        </div>

                        <div class="form-group" id="state_text">
                            <label>{{ trans('cruds.employmentDetail.fields.state') }}</label>
                            <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state_str" value="{{ old('state', '') }}">
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.state_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="city">{{ trans('cruds.employmentDetail.fields.city') }}</label>
                            <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.city_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="position_held">{{ trans('cruds.employmentDetail.fields.position_held') }}</label>
                            <input class="form-control {{ $errors->has('position_held') ? 'is-invalid' : '' }}" type="text" name="position_held" id="position_held" value="{{ old('position_held', '') }}">
                            @if($errors->has('position_held'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('position_held') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.position_held_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="industry_id">{{ trans('cruds.employmentDetail.fields.industry') }}</label>
                            <select class="form-control select2 {{ $errors->has('industry') ? 'is-invalid' : '' }}" name="industry_id" id="industry_id">
                                @foreach($industries as $id => $entry)
                                    <option value="{{ $id }}" {{ old('industry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('industry'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('industry') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employmentDetail.fields.industry_helper') }}</span>
                        </div>
                    </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="subsector_id">{{ trans('cruds.employmentDetail.fields.subsector') }}</label>
                    <select class="form-control select2 {{ $errors->has('subsector') ? 'is-invalid' : '' }}" name="subsector_id" id="subsector_id">
                        @foreach($subsectors as $id => $entry)
                            <option value="{{ $id }}" {{ old('subsector_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                        @if($errors->has('subsector'))
                            <div class="invalid-feedback">
                                {{ $errors->first('subsector') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.employmentDetail.fields.subsector_helper') }}</span>
                </div>
            </div>


                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changeCountry(){
        const state_text = document.getElementById('state_text');
        const state_dropDown = document.getElementById('state_dropDown');
        const value = $('#country').val();
        if(value !== "Nigeria"){
            state_dropDown.style.display = "none";
            //lgaContainer.style.display = "none";
            state_text.style.display = "block"
            document.getElementById('state_str').disabled = false;
        } else {
            state_dropDown.style.display = "block";
            //lgaContainer.style.display = "block";
            state_text.style.display = "none"
            document.getElementById('state_str').disabled = true;
        }
    }
    $(document).ready(() => {
        $('#country option[value="Nigeria"]').attr("selected",true);
        changeCountry();
    })
</script>
=======
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employmentDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employment-details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employer_name">{{ trans('cruds.employmentDetail.fields.employer_name') }}</label>
                <input class="form-control {{ $errors->has('employer_name') ? 'is-invalid' : '' }}" type="text" name="employer_name" id="employer_name" value="{{ old('employer_name', '') }}" required>
                @if($errors->has('employer_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employer_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.employer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employer_address">{{ trans('cruds.employmentDetail.fields.employer_address') }}</label>
                <input class="form-control {{ $errors->has('employer_address') ? 'is-invalid' : '' }}" type="text" name="employer_address" id="employer_address" value="{{ old('employer_address', '') }}">
                @if($errors->has('employer_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employer_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.employer_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employer_address_2">{{ trans('cruds.employmentDetail.fields.employer_address_2') }}</label>
                <input class="form-control {{ $errors->has('employer_address_2') ? 'is-invalid' : '' }}" type="text" name="employer_address_2" id="employer_address_2" value="{{ old('employer_address_2', '') }}">
                @if($errors->has('employer_address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employer_address_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.employer_address_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.employmentDetail.fields.country') }}</label>
                <select class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country"  onchange="changeCountry()">
                    <option value disabled {{ old('country', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($countries as $country => $data)
                        <option value="{{ $data['name']  }}" {{ old('country', '') === (string)$data['name'] ? 'selected' : '' }}>{{ $data['name']  }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.country_helper') }}</span>
            </div>
            <div class="form-group"  id="state_dropDown">
                <label>{{ trans('cruds.employmentDetail.fields.state') }}</label>
                <select class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state" id="state">
                    <option value disabled {{ old('state', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($states as $state => $label)
                        <option value="{{ $label['state'] }}" {{ old('state', '') === (string) $label['state'] ? 'selected' : '' }}>{{ $label['state'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.state_helper') }}</span>
            </div>
            <div class="form-group" id="state_text">
                <label>{{ trans('cruds.employmentDetail.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state_str"  value="{{ old('state', '') }}">
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.employmentDetail.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="position_held">{{ trans('cruds.employmentDetail.fields.position_held') }}</label>
                <input class="form-control {{ $errors->has('position_held') ? 'is-invalid' : '' }}" type="text" name="position_held" id="position_held" value="{{ old('position_held', '') }}">
                @if($errors->has('position_held'))
                    <div class="invalid-feedback">
                        {{ $errors->first('position_held') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.position_held_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="industry_id">{{ trans('cruds.employmentDetail.fields.industry') }}</label>
                <select class="form-control select2 {{ $errors->has('industry') ? 'is-invalid' : '' }}" name="industry_id" id="industry_id">
                    @foreach($industries as $id => $entry)
                        <option value="{{ $id }}" {{ old('industry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('industry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('industry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.industry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subsector_id">{{ trans('cruds.employmentDetail.fields.subsector') }}</label>
                <select class="form-control select2 {{ $errors->has('subsector') ? 'is-invalid' : '' }}" name="subsector_id" id="subsector_id">
                    @foreach($subsectors as $id => $entry)
                        <option value="{{ $id }}" {{ old('subsector_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subsector'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subsector') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employmentDetail.fields.subsector_helper') }}</span>
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
        function changeCountry(){
            const state_text = document.getElementById('state_text');
            const state_dropDown = document.getElementById('state_dropDown');
            const value = $('#country').val();
            if(value !== "Nigeria"){
                state_dropDown.style.display = "none";
                //lgaContainer.style.display = "none";
                state_text.style.display = "block"
                document.getElementById('state_str').disabled = false;
            } else {
                state_dropDown.style.display = "block";
                //lgaContainer.style.display = "block";
                state_text.style.display = "none"
                document.getElementById('state_str').disabled = true;
            }
        }
        $(document).ready(() => {
            $('#country option[value="Nigeria"]').attr("selected",true);
            changeCountry();
        })
    </script>

>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
@endsection
