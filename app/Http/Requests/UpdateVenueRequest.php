<?php

namespace App\Http\Requests;

use App\Models\Venue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVenueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('venue_edit');
    }

    public function rules()
    {
        return [
            'venue_name' => [
                'string',
                'required',
            ],
            'accessories_equipments.*' => [
                'integer',
            ],
            'accessories_equipments' => [
                'required',
                'array',
            ],
            'accessibility_features.*' => [
                'integer',
            ],
            'accessibility_features' => [
                'array',
            ],
            'venue_capacity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'size' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'venue_location_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
