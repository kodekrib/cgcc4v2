<?php

namespace App\Http\Requests;

use App\Models\Cihzone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCihzoneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cihzone_edit');
    }

    public function rules()
    {
        return [
            'zone' => [
                'string',
                'required',
                'unique:cihzones,zone,' . request()->route('cihzone')->id,
            ],
            'zone_area' => [
                'string',
                'required',
                'unique:cihzones,zone_area,' . request()->route('cihzone')->id,
            ],
            'coordinator_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
