<?php

namespace App\Http\Requests;

use App\Models\MeetingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMeetingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('meeting_type_edit');
    }

    public function rules()
    {
        return [
            'types' => [
                'string',
                'nullable',
            ],
        ];
    }
}
