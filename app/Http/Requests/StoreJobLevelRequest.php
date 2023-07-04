<?php

namespace App\Http\Requests;

use App\Models\JobLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_level_create');
    }

    public function rules()
    {
        return [
            'job_level' => [
                'string',
                'nullable',
            ],
        ];
    }
}
