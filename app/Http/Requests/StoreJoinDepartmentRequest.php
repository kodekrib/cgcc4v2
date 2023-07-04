<?php

namespace App\Http\Requests;

use App\Models\JoinDepartment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;


class StoreJoinDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('join_department_create');
    }

    public function rules()
    {
        return [
            'department_id' => [
                'required',
                'integer',
            ],
            'created_by_id' => [
                'integer',
            ],
            'status' => [
                'integer'
            ]
        ];
    }
}
