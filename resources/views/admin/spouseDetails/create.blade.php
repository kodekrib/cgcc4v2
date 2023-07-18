@extends('layouts.admin')
@section('content')

{{-- <style>
    .form-group {
        margin-top: 20px; /* Adjust the value as needed */
    }
</style> --}}

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.spouseDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.spouse-details.store") }}" enctype="multipart/form-data">
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
                    <div class="form-group" id="title">
                        <label>{{ trans('cruds.spouseDetail.fields.title') }}</label>
                        <select class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title">
                            <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            <option value="Mr" {{ old('title', '') === 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option value="Mrs" {{ old('title', '') === 'Mrs' ? 'selected' : '' }}>Mrs</option>
                        </select>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="first_name">{{ trans('cruds.spouseDetail.fields.first_name') }}</label>
                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}">
                        @if($errors->has('first_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.spouseDetail.fields.first_name_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required">{{ trans('cruds.spouseDetail.fields.relationship') }}</label>
                        <select class="form-control {{ $errors->has('relationship') ? 'is-invalid' : '' }}" name="relationship" id="relationship" required>
                            <option value disabled {{ old('relationship', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\SpouseDetail::RELATIONSHIP_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('relationship', 'Wife') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('relationship'))
                            <div class="invalid-feedback">
                                {{ $errors->first('relationship') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.spouseDetail.fields.relationship_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="last_name">{{ trans('cruds.spouseDetail.fields.last_name') }}</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{{ Auth::user()->name }}}" readonly required>
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.spouseDetail.fields.last_name_helper') }}</span>
                    </div>
                    <div class="form-group" id="maiden_name" style="display: none;">
                        <label for="maiden_name">{{ trans('cruds.spouseDetail.fields.maiden_name') }}</label>
                        <input class="form-control {{ $errors->has('maiden_name') ? 'is-invalid' : '' }}" type="text" name="maiden_name" id="maiden_name" value="{{ old('maiden_name', '') }}">
                        @if($errors->has('maiden_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('maiden_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.spouseDetail.fields.maiden_name_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="date_of_birth">{{ trans('cruds.spouseDetail.fields.date_of_birth') }}</label>
                        <input class="form-control datepicker {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="date" id="date_of_birth_input" value="{{ old('date_of_birth') }}" required>
                        @if($errors->has('date_of_birth'))
                            <div class="invalid-feedback">
                                {{ $errors->first('date_of_birth') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.spouseDetail.fields.date_of_birth_helper') }}</span>
                    </div>
                    
                    <div class="form-group">
                        <label class="required" for="wedding_anniv">{{ trans('cruds.spouseDetail.fields.wedding_anniv') }}</label>
                        <input class="form-control date {{ $errors->has('wedding_anniv') ? 'is-invalid' : '' }}" type="text" name="wedding_anniv" id="wedding_anniv" value="{{ old('wedding_anniv') }}" required>
                        @if($errors->has('wedding_anniv'))
                            <div class="invalid-feedback">
                                {{ $errors->first('wedding_anniv') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.spouseDetail.fields.wedding_anniv_helper') }}</span>
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

<!-- Add these scripts and styles to your HTML file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>
    const titleSelect = document.querySelector('select[name="title"]');
    const maidenName = document.querySelector('#maiden_name');

    titleSelect.addEventListener('change', function() {
        if (this.value === 'Mrs') {
            maidenName.style.display = 'block';
        } else {
            maidenName.style.display = 'none';
        }
    });
</script> 

<script>
    $(function () {
        // Get the current date
        const currentDate = new Date();

        // Calculate the date 3 years ago
        const threeYearsAgo = new Date(currentDate);
        threeYearsAgo.setFullYear(threeYearsAgo.getFullYear() - 3);

        // Set the max date to 3 years ago (restrict future dates)
        const maxDate = threeYearsAgo.toISOString().split('T')[0];
        $("#date_of_birth_input").attr("max", maxDate);

        // Set the date 3 years ago as the default value for the input
        const formattedThreeYearsAgo = threeYearsAgo.toISOString().split('T')[0];
        $("#date_of_birth_input").attr("value", formattedThreeYearsAgo);
    });
</script>




@endsection
