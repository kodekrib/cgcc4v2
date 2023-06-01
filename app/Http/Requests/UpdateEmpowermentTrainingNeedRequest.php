<?php

namespace App\Http\Requests;

use App\Models\EmpowermentTrainingNeed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmpowermentTrainingNeedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empowerment_training_need_edit');
    }

    public function rules()
    {
        return [
            'training_needs' => [
                'string',
                'nullable',
            ],
        ];
    }
}
