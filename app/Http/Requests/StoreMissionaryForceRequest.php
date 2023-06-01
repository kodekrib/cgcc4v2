<?php

namespace App\Http\Requests;

use App\Models\MissionaryForce;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMissionaryForceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('missionary_force_create');
    }

    public function rules()
    {
        return [];
    }
}
