<?php

namespace App\Http\Requests;

use App\Models\Christening;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChristeningRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('christening_create');
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
            'ceremony_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
