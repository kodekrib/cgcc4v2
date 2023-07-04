<?php

namespace App\Http\Requests;

use App\Models\CihCentersInspection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCihCentersInspectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cih_centers_inspection_create');
    }

    public function rules()
    {
        return [
            'date_of_inspection' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
