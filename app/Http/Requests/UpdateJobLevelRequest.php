<?php

namespace App\Http\Requests;

use App\Models\JobLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_level_edit');
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
