<div class="row">
    <div class="col-6 form-group">
        <label class="required" for="operationCode">{{ trans('cruds.mailingSetup.fields.mailing_operation_name') }}</label>
        <select class="form-control {{ $errors->has('mailing_operation_code') ? 'is-invalid' : '' }}" name="mailing_operation_code" id="mailing_operation_code_template" required onchange="GetMailTemplateByOperaionCode()">
            <option value disabled {{ old('mailing_operation_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\Member::MAILING_SETUP_OPERATION_CODE as $key => $label)
                <option value="{{ $key }}" {{ old('mailing_operation_code', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('mailing_operation_code'))
            <div class="invalid-feedback">
                {{ $errors->first('mailing_operation_code') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.mailingSetup.fields.mailing_operation_code') }}</span>
    </div>
</div>
<div id="parameter" style="padding-bottom: 10px; width: 80%; margin: auto;">

</div>
<diV>

    @include('partials.email')
</diV>
<div style="height: 50px; padding-top: 20px;">
    <button class="btn btn-success pull-right" onclick="submitMailTemplate()" style="display: block;" id="btnSubmitTemplate">
        Submit
    </button>
</div>


