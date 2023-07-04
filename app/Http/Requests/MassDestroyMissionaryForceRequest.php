<?php

namespace App\Http\Requests;

use App\Models\MissionaryForce;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMissionaryForceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('missionary_force_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:missionary_forces,id',
        ];
    }
}
