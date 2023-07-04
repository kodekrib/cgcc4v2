<?php

namespace App\Http\Requests;

use App\Models\AccessibilityFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAccessibilityFeatureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accessibility_feature_create');
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
