<?php

namespace App\Http\Requests;

use App\Models\AffinityGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAffinityGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('affinity_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:affinity_groups,id',
        ];
    }
}
