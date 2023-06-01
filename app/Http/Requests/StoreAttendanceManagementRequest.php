<?php

namespace App\Http\Requests;

use App\Models\AttendanceManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAttendanceManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendance_management_create');
    }

    public function rules()
    {
        return [
            'dateData' => [

                'required',
            ],
            'timeData' => [
                'required'
            ],
            'external_files' => [
                'array',
            ],
            'meeting_type_id' => [
                'required'
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
