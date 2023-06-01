<?php

namespace App\Http\Requests;

use App\Models\Attendee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAttendeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendee_create');
    }

    public function rules()
    {
        return [
            'attendees' => [
                'string',
                'nullable',
            ],
        ];
    }
}
