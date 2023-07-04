<?php

namespace App\Http\Requests;

use App\Models\Interest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInterestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('interest_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:interests,id',
        ];
    }
}
