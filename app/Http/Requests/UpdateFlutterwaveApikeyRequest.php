<?php

namespace App\Http\Requests;

use App\Models\FlutterwaveApikey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFlutterwaveApikeyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('flutterwave_apikey_edit');
    }

    public function rules()
    {
        return [
            'public_key' => [
                'string',
                'nullable',
            ],
            'secret_key' => [
                'string',
                'nullable',
            ],
            'encryption_key' => [
                'string',
                'nullable',
            ],
        ];
    }
}
