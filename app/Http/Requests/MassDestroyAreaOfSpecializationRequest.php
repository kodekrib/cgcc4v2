<?php

namespace App\Http\Requests;

use App\Models\AreaOfSpecialization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAreaOfSpecializationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('area_of_specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:area_of_specializations,id',
        ];
    }
}
