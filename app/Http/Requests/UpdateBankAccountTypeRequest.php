<?php

namespace App\Http\Requests;

use App\Models\BankAccountType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankAccountTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_account_type_edit');
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
