
<!-- <div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.mailingSetup.title_singular') }}
    </div>

    <div class="card-body"> -->
        <!-- <form method="POST" action="{{ route("admin.members.store") }}" enctype="multipart/form-data"> -->


            <div class="row">
                <div class="col-6 form-group">
                        <label class="required" for="operationCode">{{ trans('cruds.mailingSetup.fields.mailing_operation_name') }}</label>
                        <select class="form-control {{ $errors->has('mailing_operation_code') ? 'is-invalid' : '' }}" name="mailing_operation_code" id="mailing_operation_code" required onchange="OnchangeOperationCode()">
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
                <div class="col-6 form-group">
                        <label  for="number_email">{{ trans('cruds.mailingSetup.fields.number_email') }}</label>
                        <input class="form-control {{ $errors->has('number_email') ? 'is-invalid' : '' }}" type="text" name="number_email" id="number_email" value="{{ old('number_email', '') }}" onchange="Number_Email_change()">
                        @if($errors->has('number_email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('number_email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.mailingSetup.fields.mailing_operation_code') }}</span>
                </div>
            </div>
            <div style="height: 50px;">
                <button class="btn btn-success pull-right"  onclick="AddEmailSetting()" style="display: none;" id="btnAdd">
                    {{ trans('global.add') }} {{ trans('cruds.mailingSetup.title_singular') }}
                </button>
            </div>


            <div id="emailCOntainer">
                <!-- <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class ="row">
                        <div class="col-4 form-group">
                            <label class="required" for="operationCode">{{ trans('cruds.mailingSetup.fields.category') }}</label>
                            <select class="form-control">
                                <option value disabled selected>{{ trans('global.pleaseSelect') }}</option>
                            </select>

                        </div>

                        <div class="col-4 form-group">
                            <label class="required" for="operationCode">{{ trans('cruds.mailingSetup.fields.memberName') }}</label>
                            <select class="form-control" id="example-getting-started">
                                <option value disabled selected>{{ trans('global.pleaseSelect') }}</option>
                            </select>

                        </div>
                    </div>
                </div> -->
            </div>
            <div style="height: 50px;">
                <button class="btn btn-success pull-right" onclick="submitMailSetup()" style="display: none;" id="btnSubmit">
                    Submit
                </button>
            </div>


        <!-- </form> -->
    <!-- </div>
</div> -->


