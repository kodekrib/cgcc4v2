<?php

namespace App\Http\Requests;

use App\Models\EmpowermentTrainingNeed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmpowermentTrainingNeedRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('empowerment_training_need_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:empowerment_training_needs,id',
        ];
    }
}
