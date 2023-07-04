<?php

namespace App\Http\Requests;

use App\Models\Centre;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCentreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('centre_create');
    }

    public function rules()
    {
        return [];
    }
}
