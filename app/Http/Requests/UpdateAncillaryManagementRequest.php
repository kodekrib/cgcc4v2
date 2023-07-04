<?php

namespace App\Http\Requests;

use App\Models\AncillaryManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAncillaryManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ancillary_management_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
