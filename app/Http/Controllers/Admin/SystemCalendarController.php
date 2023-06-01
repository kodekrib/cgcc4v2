<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Booking',
            'date_field' => 'start_time',
            'field'      => 'end_time',
            'prefix'     => 'Venue booking Expires at',
            'suffix'     => 'today',
            'route'      => 'admin.bookings.edit',
        ],
        [
            'model'      => '\App\Models\AppointmentBooking',
            'date_field' => 'appointment_date',
            'field'      => 'appointment_time',
            'prefix'     => 'Appointment is scheduled at',
            'suffix'     => 'today',
            'route'      => 'admin.appointment-bookings.edit',
        ],
        [
            'model'      => '\App\Models\Meeting',
            'date_field' => 'date_of_meeting',
            'field'      => 'meeting_title',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.meetings.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
