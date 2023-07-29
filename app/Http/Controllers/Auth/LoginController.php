<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Grosv\LaravelPasswordlessLogin\LoginUrl;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Mail\UserLoginMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

// use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function sendLoginLink(Request $request)
    {

        $email = $request->get('email');

        $user = User::where('email', '=', $email)->Orwhere('mobile', '=', $email)->first();

        if(empty($user)){
            return redirect()->back()->withErrors(['email' => "Sorry, your Email ID or Mobile No. is not Registered on the System"]);
        }
        $generator = new LoginUrl($user);
        $data['url'] = $generator->generate();
        $data['user'] = $user;
        Log::info($data['url']);
        Mail::to($user->email)->send(new UserLoginMail($data));

        // return back();

        // inform the user
        return view('auth.login-sent');
    }

}
