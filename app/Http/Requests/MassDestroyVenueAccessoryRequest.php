<?php

namespace App\Http\Requests;

use App\Models\VenueAccessory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVenueAccessoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('venue_accessory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:venue_accessories,id',
        ];
    }
}
