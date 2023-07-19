@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create My Biodata
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.members.store") }}" enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="image">{{ trans('cruds.member.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.image_helper') }}</span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="title">
                    <label>{{ trans('cruds.member.fields.title') }}</label>
                    <select class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title">
                        <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        <option value="Mr" {{ old('title', '') === 'Mr' ? 'selected' : '' }}>Mr</option>
                        <option value="Mrs" {{ old('title', '') === 'Mrs' ? 'selected' : '' }}>Mrs</option>
                        <option value="Miss" {{ old('title', '') === 'Miss' ? 'selected' : '' }}>Miss</option>
                        <option value="Master" {{ old('title', '') === 'Master' ? 'selected' : '' }}>Master</option>
                        <option value="Pastor" {{ old('title', '') === 'Pastor' ? 'selected' : '' }}>Pastor</option>
                        <option value="Dr" {{ old('title', '') === 'Dr' ? 'selected' : '' }}>Dr</option>
                        <option value="Arch" {{ old('title', '') === 'Arch' ? 'selected' : '' }}>Arch</option>
                        <option value="Evangelist" {{ old('title', '') === 'Evangelist' ? 'selected' : '' }}>Evangelist</option>
                        <option value="Chief" {{ old('title', '') === 'Chief' ? 'selected' : '' }}>Chief</option>
                        <option value="Chief Mrs" {{ old('title', '') === 'Chief Mrs' ? 'selected' : '' }}>Chief Mrs</option>
                        <option value="Prophet" {{ old('title', '') === 'Prophet' ? 'selected' : '' }}>Prophet</option>
                        <option value="Deacon" {{ old('title', '') === 'Deacon' ? 'selected' : '' }}>Deacon</option>
                        <option value="Deaconess" {{ old('title', '') === 'Deaconess' ? 'selected' : '' }}>Deaconess</option>
                        <option value="Pharm" {{ old('title', '') === 'Pharm' ? 'selected' : '' }}>Pharm</option>
                    </select>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
            </div>

                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="title_id">{{ trans('cruds.member.fields.title') }}</label>
                        <select class="form-control select2 {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title_id" id="title_id" required>
                            @foreach($titles as $id => $entry)
                                <option value="{{ $id }}" {{ old('title_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.title_helper') }}</span>
                    </div>
                </div> --}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="member_name">{{ trans('cruds.member.fields.member_name') }}</label>
                        <input class="form-control {{ $errors->has('member_name') ? 'is-invalid' : '' }}" type="text" name="member_name" id="member_name" value="{{{ Auth::user()->name }}} {{{ Auth::user()->firstname }}}" readonly required>
                        @if($errors->has('member_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('member_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.member_name_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middlename">Middle Name</label>
                        <input class="form-control {{ $errors->has('middlename') ? 'is-invalid' : '' }}" type="text" name="middlename" id="middlename" value="{{ old('middlename', '') }}">
                        @if($errors->has('middlename'))
                            <div class="invalid-feedback">
                                {{ $errors->first('middlename') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.middlename_helper') }}</span>
                    </div>
                </div>

                <div class="col-md-6" id="maiden_name" style="display: none;">
                    <div class="form-group">
                    <label for="maiden_name">Maiden Name</label>
                    <input class="form-control {{ $errors->has('maiden_name') ? 'is-invalid' : '' }}" type="text" name="maiden_name" id="maiden_name" value="{{ old('maiden_name', '') }}">
                    @if($errors->has('maiden_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('maiden_name') }}
                        </div>
                    @endif

                </div>
            </div>

                {{-- <div class="col-md-6" id="maiden_name" style="display: none;">
                    <div class="form-group">
                        <label for="maiden_name">Maiden Name</label>
                        <input class="form-control {{ $errors->has('maiden_name') ? 'is-invalid' : '' }}" type="text" name="maiden_name" value="{{ old('maiden_name', '') }}">
                        @if($errors->has('maiden_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('maiden_name') }}
                            </div>
                        @endif
                    </div>
                </div> --}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">{{ trans('cruds.member.fields.mobile') }}</label>
                        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{{ Auth::user()->mobile }}}" readonly required>
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.mobile_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.member.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{{ Auth::user()->email }}}" readonly required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.email_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="date_of_birth">{{ trans('cruds.member.fields.date_of_birth') }}</label>
                        <input name="date_of_birth" id="date_of_birth" hidden/>
                        <input class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"  type="text" id="date_of_birth_date" value="{{ old('date_of_birth') }}" required onchange="calculateAge()">
                        @if($errors->has('date_of_birth'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date_of_birth') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.date_of_birth_helper') }}</span>
                    </div>
                </div>
            </div>
            <div style="display:none" id="age">
                <div class="form-group">
                  <label for="age">{{ trans('cruds.member.fields.age') }}</label>
                  <input class="form-control" type="text" value="{{ $member->age ?? '' }}" id="member_age" disabled onchange="calculateAge()">
                </div>
              </div>
            {{-- <div class="form-group">
                <label for="age">{{ trans('cruds.member.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1">
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.age_helper') }}</span>
            </div> --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.member.fields.gender') }}</label>
                        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                            <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Member::GENDER_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.gender_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="marital_status">
                        <label>{{ trans('cruds.member.fields.marital_status') }}</label>
                        <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status_select" onchange="calculateAge()">
                            <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            <option value="Divorced" {{ old('marital_status', '') === 'Divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="Divorced/Remarried" {{ old('marital_status', '') === 'Divorced/Remarried' ? 'selected' : '' }}>Divorced/Remarried</option>
                            <option value="Engaged" {{ old('marital_status', '') === 'Engaged' ? 'selected' : '' }}>Engaged</option>
                            <option value="Married" {{ old('marital_status', '') === 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widower" {{ old('marital_status', '') === 'Widower' ? 'selected' : '' }}>Widower</option>
                            <option value="Widower/Married" {{ old('marital_status', '') === 'Widower/Married' ? 'selected' : '' }}>Widower/Married</option>
                            <option value="Single" {{ old('marital_status', '') === 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Single Parent" {{ old('marital_status', '') === 'Single Parent' ? 'selected' : '' }}>Single Parent</option>
                            <option value="Widow" {{ old('marital_status', '') === 'Widow' ? 'selected' : '' }}>Widow</option>
                            <option value="Widow/Remarried" {{ old('marital_status', '') === 'Widow/Remarried' ? 'selected' : '' }}>Widow/Remarried</option>
                        </select>
                        @if($errors->has('marital_status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('marital_status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="affinity_group">{{ trans('cruds.member.fields.affinity_group') }}</label>
                        <input class="form-control {{ $errors->has('affinity_group') ? 'is-invalid' : '' }}" type="text" name="affinity_group" id="affinity_group" value="{{ old('affinity_group', '') }}" readonly required>
                        @if($errors->has('affinity_group'))
                            <div class="invalid-feedback">
                                {{ $errors->first('affinity_group') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.affinity_group_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">{{ trans('cruds.member.fields.mobile') }}</label>
                        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{{ Auth::user()->mobile }}}" readonly required>
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.mobile_helper') }}</span>
                    </div>
                </div>
            </div>

            {{-- <div class="form-group">
                <label class="required">{{ trans('cruds.member.fields.marital_status') }}</label>
                <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status" required>
                    <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Member::MARITAL_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('marital_status', 'Select Marital Status') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('marital_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marital_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.marital_status_helper') }}</span>
            </div> --}}

                    <div class="form-group">
                        <label class="required" for="employment_status_id">{{ trans('cruds.member.fields.employment_status') }}</label>
                        <select class="form-control select2 {{ $errors->has('employment_status') ? 'is-invalid' : '' }}" name="employment_status_id" id="employment_status_id" required>
                            @foreach($employment_statuses as $id => $entry)
                                <option value="{{ $id }}" {{ old('employment_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('employment_status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('employment_status') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.employment_status_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <div class="form-check {{ $errors->has('born_in_nigeria') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="born_in_nigeria" value="0">
                            <input class="form-check-input" type="checkbox" name="born_in_nigeria" id="born_in_nigeria" value="1" {{ old('born_in_nigeria', 0) == 1 ? 'checked' : '' }} onchange="changeSelect()">
                            <label class="form-check-label" for="born_in_nigeria">{{ trans('cruds.member.fields.born_in_nigeria') }}</label>
                        </div>
                        @if($errors->has('born_in_nigeria'))
                            <div class="invalid-feedback">
                                {{ $errors->first('born_in_nigeria') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.born_in_nigeria_helper') }}</span>
                    </div>
                    <div class="form-group" id="place_of_birth_id">
                        <label>{{ trans('cruds.member.fields.place_of_birth') }}</label>
                        <select class="form-control {{ $errors->has('place_of_birth') ? 'is-invalid' : '' }}" name="place_of_birth" id="state">
                            <option value disabled {{ old('place_of_birth', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach ($states as $state => $label)
                                <option value="{{ $label['state'] }}" {{ old('place_of_birth', '') === (string) $label['state']  ? 'selected' : '' }}>{{ $label['state']  }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('place_of_birth'))
                            <div class="invalid-feedback">
                                {{ $errors->first('place_of_birth') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.place_of_birth_helper') }}</span>
                    </div>
                    <div class="form-group" id="country_of_birth_id">
                        <label for="country_of_birth_id">{{ trans('cruds.member.fields.country_of_birth') }}</label>
                        <select class="form-control {{ $errors->has('country_of_birth') ? 'is-invalid' : '' }}" name="country_of_birth" id="country_of_birth_id">
                          <option value disabled {{ old('country_of_birth_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                          @foreach ($countries as $country => $data)
                            <option value="{{ $data['name'] }}" {{ old('country_of_birth', '') === (string) $data['name'] ? 'selected' : '' }}>{{ $data['name']  }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('country_of_birth'))
                            <div class="invalid-feedback">
                                {{ $errors->first('country_of_birth') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.member.fields.country_of_birth_helper') }}</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('cruds.member.fields.nationality') }}</label>
                                <select class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality" id="nationality" onchange="changeCountry()">
                                    <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach ($countries as $country => $data)
                                        <option value="{{ $data['name'] }}" {{ old('country_of_birth', '') === (string) $data['name'] ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('nationality'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nationality') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.member.fields.nationality_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="state_of_origin">
                                <label>{{ trans('cruds.member.fields.state_of_origin') }}</label>
                                <select class="form-control {{ $errors->has('state_of_origin') ? 'is-invalid' : '' }}" name="state_of_origin">
                                    <option value disabled {{ old('state_of_origin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach ($states as $state => $label)
                                        <option value="{{ $label['state'] }}" {{ old('state_of_origin', '') === (string) $label['state'] ? 'selected' : '' }}>{{ $label['state'] }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('state_of_origin'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('state_of_origin') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.member.fields.state_of_origin_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="lgaContainer">
                                <label>{{ trans('cruds.member.fields.lga') }}</label>
                                <select class="form-control {{ $errors->has('lga') ? 'is-invalid' : '' }}" name="lga" id="lga">
                                    <option value disabled {{ old('lga', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\Member::LGA_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('lga', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('lga'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('lga') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.member.fields.lga_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="address_1">{{ trans('cruds.member.fields.address_1') }}</label>
                                <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}" required>
                                @if($errors->has('address_1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address_1') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.member.fields.address_1_helper') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_2">{{ trans('cruds.member.fields.address_2') }}</label>
                                <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                                @if($errors->has('address_2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address_2') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.member.fields.address_2_helper') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="nearest_bus_stop">{{ trans('cruds.member.fields.nearest_bus_stop') }}</label>
                                <input class="form-control {{ $errors->has('nearest_bus_stop') ? 'is-invalid' : '' }}" type="text" name="nearest_bus_stop" id="nearest_bus_stop" value="{{ old('nearest_bus_stop', '') }}" required>
                                @if($errors->has('nearest_bus_stop'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nearest_bus_stop') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.member.fields.nearest_bus_stop_helper') }}</span>
                            </div>
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



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.members.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
    @if(isset($member) && $member->image)
        var file = {!! json_encode($member->image) !!}
            this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
        this.options.maxFiles = this.options.maxFiles - 1
    @endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>

<script>
    function changeSelect() {
        const born_in_nigeria = document.querySelector('#born_in_nigeria');
        const place_of_birth_id = document.querySelector('#place_of_birth_id');
        const country_of_birth_id = document.querySelector('#country_of_birth_id');

        if (born_in_nigeria.checked) {
            place_of_birth_id.style.display = "block";
            country_of_birth_id.style.display = "none";
        } else {
            place_of_birth_id.style.display = "none";
            country_of_birth_id.style.display = "block";
        }
    }

    function changeCountry(){
        const state_of_origin_text = document.getElementById('state_of_origin_text');
        const state_of_origin = document.getElementById('state_of_origin');
         const lgaContainer = document.getElementById('lgaContainer');
         $('#nationality option[value="Nigeria"]').attr("selected",true);
         const value = $('#nationality').val()

         if(value !== "Nigeria"){
            state_of_origin.style.display = "none";
            lgaContainer.style.display = "none";
            state_of_origin_text.style.display = "block"
         } else {
            state_of_origin.style.display = "block";
            lgaContainer.style.display = "block";
            state_of_origin_text.style.display = "none"
         }
    }

    window.addEventListener("load", function () {
        changeSelect();
        changeCountry();
    });
</script>

 <script>
   function fillAffinityGroup(age) {
      var marital_status =  $('#marital_status_select').val();
      if(marital_status === undefined) return;
      var affinity_group = $('[name=affinity_group]');
      marital_status = marital_status.toLowerCase();
      if (marital_status === "Single".toLowerCase()) {
        if(age >= 14 && age <= 49){
            affinity_group.val("Legacy Fellowship");
        } else if (age >= 50 ){
            affinity_group.val( "Crown of Glory");
        }

      } else if (marital_status === "Married".toLowerCase()) {
        if (age >= 50 ) {
            affinity_group.val( "Crown of Glory, Couple Fellowship");
        } else {
            affinity_group.val("Couple Fellowship");
        }
      } else if (
        ["Widow".toLowerCase(), "Widower".toLowerCase(), "Divorced".toLowerCase(), "Separated".toLowerCase(), "Single Parent".toLowerCase()].includes(marital_status)
      ) {

        if(age >= 50){
            affinity_group.val("Crown of Glory, 686 Fellowship");
        } else {
            affinity_group.val("686 Fellowship");
        }

      } else {
        affinity_group.val( "");
      }
    }

    function calculateAge(){
     var dt = (new Date('{{date('Y-m-d')}}'));
     $('#date_of_birth').val(formatDate());
     var selectDate = (new Date($('#date_of_birth_date').val()));
     $('member_age').val(dt.getFullYear() - selectDate.getFullYear());
     debugger;
     this.fillAffinityGroup(dt.getFullYear() - selectDate.getFullYear());
    }

    function formatDate() {
        const value = document.getElementById("date_of_birth_date").value;
        const date = new Date(value);

        const year = date.getFullYear() + "";
        let month = date.getMonth() + 1 + "";
        let day = date.getDate() + "";

        if (day.length == 1) day = "0" + day;
        if (month.length == 1) month = "0" + month;

        const formattedDate = day  + "/" + month + "/" + year;

        return formattedDate;
}
  </script>

<script>
    $(document).ready(function () {
         // Restrict dates to 5 years ago
        var today = new Date();
        var fiveYearsAgo = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());
        var formattedFiveYearsAgo = fiveYearsAgo.toISOString().split('T')[0];

        // On change of state select field
        $('#date_of_birth_date').datetimepicker({
        format: 'MM-DD-YYYY',
        locale: 'en',
        maxDate: new Date(formattedFiveYearsAgo),
        icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            },
        });
        $('#state_of_origin').on('change', function () {
            $('#lga').empty();
                // Use Ajax to get the LGAs for the selected state
                $.ajax({
                    url: '/Json/nigeria-state-and-lgas.json',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Clear current options in the LGA select field
                        $('#lga').empty();
                        // Get Selected State Of Origin
                        var dt = $('select[name="state_of_origin"]');

                        const selectedState = data.find(x => x.state === dt.val());
                        if(selectedState === undefined) return;
                        // Add options for the LGAs
                        $('#lga').append($('<option>', { value: '', text: '{{ trans('global.pleaseSelect') }}' }));
                        $.each(selectedState.lgas, function (key, value) {
                            $('#lga').append($('<option>', { value: value, text: value }));
                        });
                    }
                });

        });
    });
</script>



{{-- <script>
    const titleSelect = document.querySelector('select[name="title"]');
    const maidenName = document.querySelector('#maiden_name');

    titleSelect.addEventListener('change', function() {
        if (this.value === 'Mr') {
            maidenName.style.display = 'block';
        } else {
            maidenName.style.display = 'none';
        }
    });
</script>  --}}

<script>
    const titleSelect = document.querySelector('select[name="title"]');
    const maidenName = document.querySelector('#maiden_name');

    titleSelect.addEventListener('change', function() {
        if (
            this.value === 'Pastor' ||
            this.value === 'Dr' ||
            this.value === 'Mrs' ||
            this.value === 'Chief Mrs' ||
            this.value === 'Evangelist' ||
            this.value === 'Engr' ||
            this.value === 'Rev' ||
            this.value === 'Prophet' ||
            this.value === 'Deacon' ||
            this.value === 'Deaconess' ||
            this.value === 'Pharm' ||
            this.value === 'Arch' ||
            this.value === 'Chief'
        ) {
            maidenName.style.display = 'block';
        } else {
            maidenName.style.display = 'none';
        }
    });
</script>



@endsection
