<?php

namespace App\Http\Requests;

use App\Models\Attendee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAttendeeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:attendees,id',
        ];
    }
}
