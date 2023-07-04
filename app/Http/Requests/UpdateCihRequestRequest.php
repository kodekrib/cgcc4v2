<?php

namespace App\Http\Requests;

use App\Models\CihRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCihRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cih_request_edit');
    }

    public function rules()
    {
        return [
            'date_of_request' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_of_request_event' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
