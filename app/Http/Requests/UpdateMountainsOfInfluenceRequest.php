<?php

namespace App\Http\Requests;

use App\Models\MountainsOfInfluence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMountainsOfInfluenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mountains_of_influence_edit');
    }

    public function rules()
    {
        return [
            'nation' => [
                'string',
                'required',
            ],
            'corresponding_mountain' => [
                'string',
                'required',
            ],
            'prevailing_culture' => [
                'string',
                'required',
            ],
            'counter_culture' => [
                'string',
                'required',
            ],
            'counter_culture_text' => [
                'string',
                'required',
            ],
            'attributes_of_christ' => [
                'string',
                'required',
            ],
            'motivational_gifts' => [
                'string',
                'required',
            ],
            'mountain_leader_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
