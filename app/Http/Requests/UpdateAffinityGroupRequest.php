<?php

namespace App\Http\Requests;

use App\Models\AffinityGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAffinityGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('affinity_group_edit');
    }

    public function rules()
    {
        return [
            'affinity_group' => [
                'string',
                'required',
            ],
            'affinity_group_code' => [
                'string',
                'required',
            ],
            'criteria' => [
                'string',
                'required',
            ],
            'head_of_group_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
