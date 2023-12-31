<?php

namespace App\Http\Requests;

use App\Models\MaritalStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaritalStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('marital_status_edit');
    }

    public function rules()
    {
        return [
            'marital_status' => [
                'string',
                'required',
            ],
        ];
    }
}
