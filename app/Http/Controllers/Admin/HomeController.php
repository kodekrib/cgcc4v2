<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Member;
use Carbon\Carbon;

class HomeController
{
    public function index()
    {
        $totalMembers = Member::count(); // Total number of members
        $totalMale = Member::where('gender', 'Male')->count();
        $totalFemale = Member::where('gender', 'Female')->count();

        $totalAdults = Member::where('age', '>=', 18)->count(); // Number of members who are adults (age >= 18)
        $totalChildren = Member::where('age', '<', 18)->count(); // Number of members who are children (age < 18)

        // $progressPercentage = ($totalAdults / $totalMembers) * 100;

        return view('dashboard', compact('totalMembers', 'totalMale', 'totalFemale', 'totalChildren', 'totalAdults'));
    }

    private function getGreeting()
    {
        $now = Carbon::now();
        $hour = $now->hour;
    
        if ($hour >= 5 && $hour < 12) {
            return 'Good Morning';
        } elseif ($hour >= 12 && $hour < 17) {
            return 'Good Afternoon';
        } elseif ($hour >= 17 && $hour < 21) {
            return 'Good Evening';
        } else {
            return 'Good Night';
        }
    }
}
