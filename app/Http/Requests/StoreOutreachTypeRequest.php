<?php

namespace App\Http\Requests;

use App\Models\OutreachType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOutreachTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('outreach_type_create');
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
