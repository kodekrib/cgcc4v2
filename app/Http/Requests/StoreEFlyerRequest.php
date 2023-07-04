<?php

namespace App\Http\Requests;

use App\Models\EFlyer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEFlyerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('e_flyer_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'image' => [
                'array',
            ],
        ];
    }
}
