<?php

namespace App\Http\Requests;

use App\Models\Empowerment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmpowermentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('empowerment_create');
    }

    public function rules()
    {
        return [
            'cooperative' => [
                'required',
            ],
            'contribution_amount' => [

            ],
            'contribution_frequency' => [

            ],
            'start_year' => [

                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'start_month' => [

            ],
            'business_advisory' => [
                'required',
            ],
            'advisory_team' => [
                'string',
                'nullable',
            ],
            'training_needs.*' => [
                'integer',
            ],
            'training_needs' => [
                'array',
            ],
        ];
    }
}
