<?php

namespace App\Http\Requests;

use App\Models\InspectorateGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInspectorateGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('inspectorate_group_create');
    }

    public function rules()
    {
        return [
            'surname' => [
                'string',
                'nullable',
            ],
            'first_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
