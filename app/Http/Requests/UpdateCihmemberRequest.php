<?php

namespace App\Http\Requests;

use App\Models\Cihmember;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCihmemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cihmember_edit');
    }

    public function rules()
    {
        return [];
    }
}
