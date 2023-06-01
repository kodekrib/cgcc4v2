<?php

namespace App\Http\Requests;

use App\Models\MountainOfInfluence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMountainOfInfluenceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mountain_of_influence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mountain_of_influences,id',
        ];
    }
}
