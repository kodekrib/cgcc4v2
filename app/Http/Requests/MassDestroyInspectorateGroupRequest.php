<?php

namespace App\Http\Requests;

use App\Models\InspectorateGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInspectorateGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('inspectorate_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:inspectorate_groups,id',
        ];
    }
}
