<?php

namespace App\Http\Requests;

use App\Models\Meeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('meeting_edit');
    }

    public function rules()
    {
        return [
            'date_of_meeting' => [

                'nullable',
            ],
            'time_duration' => [
                'string',
                'nullable',
            ],
            'meeting_title' => [
                'string',
                'required',
            ],
            'venue_id' => [
                'required',
                'integer',
            ],
            'meeting_minutes' => [
                'array',
            ],
            'files' => [
                'array',
            ],
        ];
    }
}
