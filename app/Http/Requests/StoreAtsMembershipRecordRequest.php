<?php

namespace App\Http\Requests;

use App\Models\AtsMembershipRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAtsMembershipRecordRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ats_membership_record_create');
    }

    public function rules()
    {
        return [
            'ats_membership_no' => [
                'string',
                'nullable',
            ],
            'names' => [
                'string',
                'nullable',
            ],
            'batch' => [
                'string',
                'nullable',
            ],
            'year' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'month' => [
                'string',
                'nullable',
            ],
        ];
    }
}
