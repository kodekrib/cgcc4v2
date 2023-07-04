<?php

namespace App\Http\Requests;

use App\Models\AttendanceManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAttendanceManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_management_edit');
    }

    public function rules()
    {
        return [
            // 'date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
            // 'external_files' => [
            //     'array',
            // ],
            // 'members_in_attendances.*' => [
            //     'integer',
            // ],
            // 'members_in_attendances' => [
            //     'required',
            //     'array',
            // ],

            'dateData' => [

                'required',
            ],
            'timeData' => [
                'required'
            ],
            'external_files' => [
                'array',
            ],

            'members_in_attendancesL' => [


            ],
            'members_in_excuse' => [

            ],
            'members_in_absence' => [

            ]
        ];
    }
}
