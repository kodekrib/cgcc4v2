<?php

namespace App\Http\Requests;

use App\Models\IndustrySector;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIndustrySectorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('industry_sector_create');
    }

    public function rules()
    {
        return [
            'industry' => [
                'string',
                'required',
            ],
        ];
    }
}
