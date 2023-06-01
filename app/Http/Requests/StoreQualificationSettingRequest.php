<?php

namespace App\Http\Requests;

use App\Models\QualificationSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQualificationSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('qualification_setting_create');
    }

    public function rules()
    {
        return [
            'highest_qualification' => [
                'string',
                'required',
            ],
        ];
    }
}
