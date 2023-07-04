<?php

namespace App\Http\Requests;

use App\Models\EmploymentStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmploymentStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employment_status_create');
    }

    public function rules()
    {
        return [
            'employment_status' => [
                'string',
                'required',
            ],
        ];
    }
}
