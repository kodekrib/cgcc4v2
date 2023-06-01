<?php

namespace App\Http\Requests;

use App\Models\AtsMembershipRecord;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAtsMembershipRecordRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ats_membership_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ats_membership_records,id',
        ];
    }
}
