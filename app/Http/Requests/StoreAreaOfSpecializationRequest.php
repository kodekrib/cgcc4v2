<?php

namespace App\Http\Requests;

use App\Models\AreaOfSpecialization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAreaOfSpecializationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('area_of_specialization_create');
    }

    public function rules()
    {
        return [
            'area_of_specialization' => [
                'string',
                'nullable',
            ],
        ];
    }
}
