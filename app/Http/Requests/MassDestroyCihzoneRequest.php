<?php

namespace App\Http\Requests;

use App\Models\Cihzone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCihzoneRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cihzone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cihzones,id',
        ];
    }
}
