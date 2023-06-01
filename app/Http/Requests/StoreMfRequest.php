<?php

namespace App\Http\Requests;

use App\Models\Mf;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMfRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mf_create');
    }

    public function rules()
    {
        return [];
    }
}
