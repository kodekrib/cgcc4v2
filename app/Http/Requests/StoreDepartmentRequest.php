<?php

namespace App\Http\Requests;

use App\Models\Department;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('department_create');
    }

    public function rules()
    {
        return [
            'dept_code' => [
                'string',
                'required',
            ],
            'department_name' => [
                'string',
                'required',
            ],
            'department_email' => [
                'required',
                'unique:departments',
            ],
            'hod_id' => [
                'required',
                'integer',
            ],
            'organization_type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
