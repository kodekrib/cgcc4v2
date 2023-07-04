<?php

namespace App\Http\Requests;

use App\Models\MissionaryForce;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMissionaryForceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('missionary_force_edit');
    }

    public function rules()
    {
        return [];
    }
}
