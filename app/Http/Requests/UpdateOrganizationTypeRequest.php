<?php

namespace App\Http\Requests;

use App\Models\OrganizationType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrganizationTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organization_type_edit');
    }

    public function rules()
    {
        return [
            'organization_type' => [
                'string',
                'required',
                'unique:organization_types,organization_type,' . request()->route('organization_type')->id,
            ],
        ];
    }
}
