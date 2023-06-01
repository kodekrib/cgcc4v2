<?php

namespace App\Http\Requests;

use App\Models\MountainsOfInfluence;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMountainsOfInfluenceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mountains_of_influence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mountains_of_influences,id',
        ];
    }
}
