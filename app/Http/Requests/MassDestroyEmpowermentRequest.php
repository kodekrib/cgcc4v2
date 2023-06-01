<?php

namespace App\Http\Requests;

use App\Models\Empowerment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmpowermentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('empowerment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:empowerments,id',
        ];
    }
}
