<?php

namespace App\Http\Requests;

use App\Models\MembersAffinityGroup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMembersAffinityGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('members_affinity_group_create');
    }

    public function rules()
    {
        return [
            'affinity_group' => [
                'string',
                'nullable',
            ],
            'marital_status' => [
                'string',
                'nullable',
            ],
            'age_range' => [
                'string',
                'nullable',
            ],

        ];
    }
}
