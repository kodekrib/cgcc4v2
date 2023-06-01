<?php

namespace App\Http\Requests;

use App\Models\Dedication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDedicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dedication_edit');
    }

    public function rules()
    {
        return [
            'parent' => [
                'string',
                'nullable',
            ],
            'no_at_birth' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_of_dedication' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'department' => [
                'string',
                'nullable',
            ],
        ];
    }
}
