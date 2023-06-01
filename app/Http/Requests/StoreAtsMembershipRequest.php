<?php

namespace App\Http\Requests;

use App\Models\AtsMembership;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAtsMembershipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ats_membership_create');
    }

    public function rules()
    {
        return [];
    }
}
