<?php

namespace App\Http\Requests;

use App\Models\SpouseDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpouseDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('spouse_detail_create');
    }

    public function rules()
    {
        return [
            'last_name' => [
                'string',
                'required',
            ],
            'first_name' => [
                'string',
                'nullable',
            ],
            'maiden_name' => [
                'string',
                'nullable',
            ],
            'relationship' => [
                'required',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'wedding_anniv' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
