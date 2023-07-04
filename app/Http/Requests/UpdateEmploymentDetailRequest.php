<?php

namespace App\Http\Requests;

use App\Models\EmploymentDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmploymentDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employment_detail_edit');
    }

    public function rules()
    {
        return [
            'employer_name' => [
                'string',
                'required',
            ],
            'employer_address' => [
                'string',
                'nullable',
            ],
            'employer_address_2' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'position_held' => [
                'string',
                'nullable',
            ],
        ];
    }
}
