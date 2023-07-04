<?php

namespace App\Http\Requests;

use App\Models\CihRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCihRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cih_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cih_requests,id',
        ];
    }
}
