<?php

namespace App\Http\Requests;

use App\Models\EFlyer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEFlyerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('e_flyer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:e_flyers,id',
        ];
    }
}
