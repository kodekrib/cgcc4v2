<?php

namespace App\Http\Requests;

use App\Models\CihTypesOfRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCihTypesOfRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cih_types_of_request_edit');
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
