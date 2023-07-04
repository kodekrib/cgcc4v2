<?php

namespace App\Http\Requests;

use App\Models\MembersAffinityGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMembersAffinityGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('members_affinity_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:members_affinity_groups,id',
        ];
    }
}
