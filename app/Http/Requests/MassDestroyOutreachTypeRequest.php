<?php

namespace App\Http\Requests;

use App\Models\OutreachType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOutreachTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('outreach_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:outreach_types,id',
        ];
    }
}
