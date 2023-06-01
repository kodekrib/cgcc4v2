<?php

namespace App\Http\Requests;

use App\Models\CihTypesOfRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCihTypesOfRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cih_types_of_request_create');
    }

    public function rules()
    {
        return [
            'types_of_request' => [
                'string',
                'nullable',
            ],
        ];
    }
}
