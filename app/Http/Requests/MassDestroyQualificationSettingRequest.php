<?php

namespace App\Http\Requests;

use App\Models\QualificationSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQualificationSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('qualification_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:qualification_settings,id',
        ];
    }
}
