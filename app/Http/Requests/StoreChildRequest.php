<?php

namespace App\Http\Requests;

use App\Models\Child;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChildRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('child_create');
    }

    public function rules()
    {
        return [
            'full_names' => [
                'string',
                'required',
                'unique:children',
            ],
            'mobile' => [
                'string',
                'nullable',
            ],
            'relationship' => [
                'required',
            ],
            'specify' => [
                'string',
                'nullable',
            ],
            'position_in_family' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'father_name_id' => [
                'required',
                'integer',
            ],
            'mothers_name_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
