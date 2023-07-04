<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $totalMale = Member::where('gender', 'Male')->count();
        $totalFemale = Member::where('gender', 'Female')->count();

        return view('dashboard', compact('totalMembers', 'totalMale', 'totalFemale'));
    }

}
