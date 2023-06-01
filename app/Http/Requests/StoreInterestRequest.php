<?php

namespace App\Http\Requests;

use App\Models\Interest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInterestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('interest_create');
    }

    public function rules()
    {
        return [
            'interests.*' => [
                'integer',
            ],
            'interests' => [
                'array',
            ],
            'other_sports' => [
                'string',
                'nullable',
            ],
            'social_causes' => [
                'string',
                'nullable',
            ],
            'entrepreneurial_interests' => [
                'string',
                'nullable',
            ],
        ];
    }
}
