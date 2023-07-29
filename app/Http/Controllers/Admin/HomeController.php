<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Member;
use App\Models\Meeting;
use Carbon\Carbon;

class HomeController
{

    public function index()
    {
        $totalMembers = Member::count(); // Total number of members
        $totalMale = Member::where('gender', 'Male')->count();
        $totalFemale = Member::where('gender', 'Female')->count();

        $totalAdults = Member::where('age', '>=', 18)
                            ->whereNotNull('age') // Exclude NULL values
                            ->whereRaw('age REGEXP "^[0-9]+$"') // Ensure only numeric values
                            ->count();

        $totalChildren = Member::where('age', '<', 18)
                            ->whereNotNull('age') // Exclude NULL values
                            ->whereRaw('age REGEXP "^[0-9]+$"') // Ensure only numeric values
                            ->count();

        // $progressPercentage = ($totalAdults / $totalMembers) * 100;

                // Fetch upcoming meetings scheduled in the future
        $upcomingMeetings = Meeting::where('date_of_meeting', '>=', Carbon::now())->get();


        return view('dashboard', compact('totalMembers', 'totalMale', 'totalFemale', 'totalChildren', 'totalAdults', 'upcomingMeetings'));
    }
}
