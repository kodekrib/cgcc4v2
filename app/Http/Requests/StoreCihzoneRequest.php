<?php

namespace App\Http\Requests;

use App\Models\Cihzone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCihzoneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cihzone_create');
    }

    public function rules()
    {
        return [
            'zone' => [
                'string',
                'required',
                'unique:cihzones',
            ],
            'zone_area' => [
                'string',
                'required',
                'unique:cihzones',
            ],
            'coordinator_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
