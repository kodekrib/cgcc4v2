<?php

namespace App\Http\Requests;

use App\Models\VenueAccessory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVenueAccessoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('venue_accessory_edit');
    }

    public function rules()
    {
        return [
            'accessories' => [
                'string',
                'required',
            ],
        ];
    }
}
