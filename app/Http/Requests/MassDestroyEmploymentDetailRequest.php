<?php

namespace App\Http\Requests;

use App\Models\EmploymentDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmploymentDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('employment_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:employment_details,id',
        ];
    }
}
