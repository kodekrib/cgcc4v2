<?php

namespace App\Http\Requests;

use App\Models\FlutterwaveApikey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFlutterwaveApikeyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('flutterwave_apikey_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:flutterwave_apikeys,id',
        ];
    }
}
