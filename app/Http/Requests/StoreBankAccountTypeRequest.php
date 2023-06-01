<?php

namespace App\Http\Requests;

use App\Models\BankAccountType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBankAccountTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_account_type_create');
    }

    public function rules()
    {
        return [
            'account_type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
