<?php

namespace App\Http\Requests;

use App\Models\MembersAffinityGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMembersAffinityGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('members_affinity_group_edit');
    }

    public function rules()
    {
        return [
            'affinity_group' => [
                'string',
                'nullable',
            ],
        ];
    }
}
