<?php

namespace App\Http\Requests;

use App\Models\OutreachType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOutreachTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('outreach_type_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
