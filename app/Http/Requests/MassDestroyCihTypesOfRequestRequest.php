<?php

namespace App\Http\Requests;

use App\Models\CihTypesOfRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCihTypesOfRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cih_types_of_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cih_types_of_requests,id',
        ];
    }
}
