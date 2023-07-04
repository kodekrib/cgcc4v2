<?php

namespace App\Http\Requests;

use App\Models\FirstTimer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFirstTimerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('first_timer_edit');
    }

    public function rules()
    {
        return [
            'service' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'surname' => [
                'string',
                'nullable',
            ],
            'first_name' => [
                'string',
                'nullable',
            ],
            'middle_name' => [
                'string',
                'nullable',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'occupation' => [
                'string',
                'nullable',
            ],
            'age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phone_number' => [
                'string',
                'nullable',
            ],
            'nearest_bus_stop' => [
                'string',
                'nullable',
            ],
        ];
    }
}
