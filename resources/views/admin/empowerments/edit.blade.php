@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.empowerment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.empowerments.update", [$empowerment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ats_membership_no_id">{{ trans('cruds.empowerment.fields.ats_membership_no') }}</label>
                <select class="form-control select2 {{ $errors->has('ats_membership_no') ? 'is-invalid' : '' }}" name="ats_membership_no_id" id="ats_membership_no_id">
                    @foreach($ats_membership_nos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ats_membership_no_id') ? old('ats_membership_no_id') : $empowerment->ats_membership_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ats_membership_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ats_membership_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowerment.fields.ats_membership_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.empowerment.fields.cooperative') }}</label>
                <select class="form-control {{ $errors->has('cooperative') ? 'is-invalid' : '' }}" name="cooperative" id="cooperative" required onchange="onCooperativeSelected()">
                    <option value disabled {{ old('cooperative', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Empowerment::COOPERATIVE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cooperative', $empowerment->cooperative) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cooperative'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cooperative') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowerment.fields.cooperative_helper') }}</span>
            </div>
            <div id="container_coperative">
                <div class="form-group">
                    <label class="required" for="contribution_amount">{{ trans('cruds.empowerment.fields.contribution_amount') }}</label>
                    <input class="form-control {{ $errors->has('contribution_amount') ? 'is-invalid' : '' }}" type="number" name="contribution_amount" id="contribution_amount" value="{{ old('contribution_amount', $empowerment->contribution_amount) }}" step="0.01" >
                    @if($errors->has('contribution_amount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contribution_amount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.contribution_amount_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.empowerment.fields.contribution_frequency') }}</label>
                    <select class="form-control {{ $errors->has('contribution_frequency') ? 'is-invalid' : '' }}" name="contribution_frequency" id="contribution_frequency" >
                        <option value disabled {{ old('contribution_frequency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Empowerment::CONTRIBUTION_FREQUENCY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('contribution_frequency', $empowerment->contribution_frequency) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('contribution_frequency'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contribution_frequency') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.contribution_frequency_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="start_year">{{ trans('cruds.empowerment.fields.start_year') }}</label>
                    <input class="form-control {{ $errors->has('start_year') ? 'is-invalid' : '' }}" type="number" name="start_year" id="start_year" value="{{ old('start_year', $empowerment->start_year) }}" step="1" >
                    @if($errors->has('start_year'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_year') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.start_year_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.empowerment.fields.start_month') }}</label>
                    <select class="form-control {{ $errors->has('start_month') ? 'is-invalid' : '' }}" name="start_month" id="start_month" >
                        <option value disabled {{ old('start_month', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Empowerment::START_MONTH_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('start_month', $empowerment->start_month) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('start_month'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_month') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.start_month_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.empowerment.fields.business_advisory') }}</label>
                <select class="form-control {{ $errors->has('business_advisory') ? 'is-invalid' : '' }}" name="business_advisory" id="business_advisory" required>
                    <option value disabled {{ old('business_advisory', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Empowerment::BUSINESS_ADVISORY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('business_advisory', $empowerment->business_advisory) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('business_advisory'))
                    <div class="invalid-feedback">
                        {{ $errors->first('business_advisory') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowerment.fields.business_advisory_helper') }}</span>
            </div>
            <div class="form-group" id="container_advisory_team">
                <label for="advisory_team">{{ trans('cruds.empowerment.fields.advisory_team') }}</label>
                <input class="form-control {{ $errors->has('advisory_team') ? 'is-invalid' : '' }}" type="text" name="advisory_team" id="advisory_team" value="{{ old('advisory_team', $empowerment->advisory_team) }}">
                @if($errors->has('advisory_team'))
                    <div class="invalid-feedback">
                        {{ $errors->first('advisory_team') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowerment.fields.advisory_team_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.empowerment.fields.trainings') }}</label>
                <select class="form-control {{ $errors->has('trainings') ? 'is-invalid' : '' }}" name="trainings" id="trainings">
                    <option value disabled {{ old('trainings', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Empowerment::TRAININGS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('trainings', $empowerment->trainings) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('trainings'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trainings') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowerment.fields.trainings_helper') }}</span>
            </div>
            <div class="form-group" id="container_training_needs">
                <label for="training_needs">{{ trans('cruds.empowerment.fields.training_needs') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('training_needs') ? 'is-invalid' : '' }}" name="training_needs[]" id="training_needs" multiple>
                    @foreach($training_needs as $id => $training_need)
                        <option value="{{ $id }}" {{ (in_array($id, old('training_needs', [])) || $empowerment->training_needs->contains($id)) ? 'selected' : '' }}>{{ $training_need }}</option>
                    @endforeach
                </select>
                @if($errors->has('training_needs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('training_needs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empowerment.fields.training_needs_helper') }}</span>
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
         function onAdvisoryTeamSelected(){
            const advisory_teamOpt = $('#business_advisory').val();
            if(advisory_teamOpt == 'yes'){
                document.getElementById('container_advisory_team').style.display = 'block';
            } else {
                document.getElementById('container_advisory_team').style.display = 'none';
                $('#advisory_team').val(null);

            }
         }

         function onTrainingNeedsSelected(){
            const training_needsOpt = $('#trainings').val();
            if(training_needsOpt == 'yes'){
                document.getElementById('container_training_needs').style.display = 'block';
            } else {
                document.getElementById('container_training_needs').style.display = 'none';
                $('#training_needs').val(null);

            }
         }
        function onCooperativeSelected(){
            const cooperativeOpt = $('#cooperative').val();
            if(cooperativeOpt == 'yes'){
                document.getElementById('container_coperative').style.display = 'block';
            } else {
                document.getElementById('container_coperative').style.display = 'none';
                $('#contribution_amount').val(0);
                $('#contribution_frequency').val(null);
                $('#start_year').val(new Date().getFullYear());
                $('#start_month').val(null);
            }
        }
        $(document ).ready(() =>{
            onCooperativeSelected();
            onAdvisoryTeamSelected();
            onTrainingNeedsSelected();
        });
    </script>
@endsection
