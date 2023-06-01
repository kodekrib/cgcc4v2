<?php

namespace App\Http\Requests;

use App\Models\MeetingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMeetingTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('meeting_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:meeting_types,id',
        ];
    }
}
