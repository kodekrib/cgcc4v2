<?php

namespace App\Http\Requests;

use App\Models\CihCentersInspection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCihCentersInspectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cih_centers_inspection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cih_centers_inspections,id',
        ];
    }
}
