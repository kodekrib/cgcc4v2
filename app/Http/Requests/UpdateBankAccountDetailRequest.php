<?php

namespace App\Http\Requests;

use App\Models\BankAccountDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankAccountDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_account_detail_edit');
    }

    public function rules()
    {
        return [
            'account_name' => [
                'string',
                'nullable',
            ],
            'account_number' => [
                'string',
                'nullable',
            ],
            'sort_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
