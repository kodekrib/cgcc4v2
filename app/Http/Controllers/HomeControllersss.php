<?php

// namespace App\Http\Controllers;

namespace App\Http\Controllers;


use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $memberExist = Member::all()->where('email', Auth::user()->email)->first();

    //     return view('home', compact('memberExist'));
    // }

    public function index()
    {
        return view('home');
    }
}
