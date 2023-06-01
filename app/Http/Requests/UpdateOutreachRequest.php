<?php

namespace App\Http\Requests;

use App\Models\Outreach;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOutreachRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('outreach_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
