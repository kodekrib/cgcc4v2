<?php

namespace App\Http\Requests;

use App\Models\AppointmentBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_booking_create');
    }

    public function rules()
    {
        return [
            'member_name' => [
                'string',
                'nullable',
            ],
            'appointment_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'appointment_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'purpose' => [
                'required',
            ],
             'assigned_to_id' => [

            ],
        ];
    }
}
