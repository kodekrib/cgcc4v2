<?php

namespace App\Http\Requests;

use App\Models\Mailing;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMailingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mailing_create');
    }

    public function rules()
    {
        return [];
    }
}
