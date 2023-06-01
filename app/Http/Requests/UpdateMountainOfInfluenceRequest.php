<?php

namespace App\Http\Requests;

use App\Models\MountainOfInfluence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMountainOfInfluenceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mountain_of_influence_edit');
    }

    public function rules()
    {
        return [];
    }
}
