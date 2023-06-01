<?php

namespace App\Http\Requests;

use App\Models\IssueManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIssueManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('issue_management_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'issue_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
