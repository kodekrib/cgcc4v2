<?php

namespace App\Http\Requests;

use App\Models\JoinDepartment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJoinDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('join_department_edit');
    }

    public function rules()
    {
        return [
            'department_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
