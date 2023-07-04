<?php

namespace App\Http\Requests;

use App\Models\AncillaryManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAncillaryManagementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ancillary_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ancillary_managements,id',
        ];
    }
}
