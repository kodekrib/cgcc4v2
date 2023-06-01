<?php

namespace App\Http\Requests;

use App\Models\JoinDepartment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyJoinDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('join_department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:join_departments,id',
        ];
    }
}
