<?php

namespace App\Http\Requests;

use App\Models\Cihmember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCihmemberRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cihmember_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cihmembers,id',
        ];
    }
}
