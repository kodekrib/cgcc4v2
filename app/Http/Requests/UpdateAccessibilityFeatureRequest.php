<?php

namespace App\Http\Requests;

use App\Models\AccessibilityFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAccessibilityFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accessibility_feature_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
