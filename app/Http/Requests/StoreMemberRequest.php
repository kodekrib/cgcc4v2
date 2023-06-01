<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_create');
    }

    public function rules()
    {
        return [
            'title_id' => [
                'required',
                'integer',
            ],
            'member_name' => [
                'string',
                'required',
            ],
            'middlename' => [
                'string',
                'nullable',
            ],
            'mobile' => [
                'string',
                'nullable',
            ],
            'email' => [
                'required',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'age' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'gender' => [
                'required',
            ],
            'marital_status' => [
                'required',
            ],
            'born_in_nigeria' => [

            ],
            'country_of_birth' => [

            ],
            'nationality' => [
                'required',
            ],
            'state_of_origin' => [

            ],
            'lga' => [

            ],
            'place_of_birth' => [

            ],
            'employment_status_id' => [
                'required',
                'integer',
            ],
            'address_1' => [
                'string',
                'required',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'nearest_bus_stop' => [
                'string',

            ],
            'affinity_group' => [

            ],
        ];
    }
}
