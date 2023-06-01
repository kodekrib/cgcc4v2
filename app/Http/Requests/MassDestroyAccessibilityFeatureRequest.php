<?php

namespace App\Http\Requests;

use App\Models\AccessibilityFeature;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAccessibilityFeatureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('accessibility_feature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:accessibility_features,id',
        ];
    }
}
