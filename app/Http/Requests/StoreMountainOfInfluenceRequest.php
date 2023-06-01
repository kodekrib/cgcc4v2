<?php

namespace App\Http\Requests;

use App\Models\MountainOfInfluence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMountainOfInfluenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mountain_of_influence_create');
    }

    public function rules()
    {
        return [];
    }
}
