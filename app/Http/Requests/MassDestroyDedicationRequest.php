<?php

namespace App\Http\Requests;

use App\Models\Dedication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDedicationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dedication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:dedications,id',
        ];
    }
}
