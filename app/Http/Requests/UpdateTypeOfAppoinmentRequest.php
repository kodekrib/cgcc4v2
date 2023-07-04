<?php

namespace App\Http\Requests;

use App\Models\TypeOfAppoinment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTypeOfAppoinmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_of_appoinment_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
            'members_list.*' => [
                'integer',
            ],
            'members_list' => [
                'required',
                'array',
            ],
            'default_members_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
