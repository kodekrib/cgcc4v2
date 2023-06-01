<?php

namespace App\Http\Requests;

use App\Models\Mf;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMfRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mf_edit');
    }

    public function rules()
    {
        return [];
    }
}
