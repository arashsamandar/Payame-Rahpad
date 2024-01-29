<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User as User;
use App\Logs;

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


    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view('auth.login',['page_title' => 'ورود به سایت']);
    }

    public function login(Request $request, Logs $logs)
    {

        $username = $request->input('username');
        $password = $request->input('password');


        $message = array(
            'username.required' => 'نام کاربری را وارد کنید',
            'password.required' => 'رمز عبور را وارد کنید'
        );


        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required'
            ],$message
        );

        if(!empty(User::where('username',$username)->first())) {
            $myuser1 = User::where('username',$username)->first();
        } elseif (!empty(User::where('email',$username)->first())) {
            $myuser1 = User::where('email',$username)->first();
        }

        if (\Auth::attempt(['username' => $username, 'password' => $password])) {

            $logdata = [];
            $dateTime = Carbon::now();
            $logdata['logDate'] = $dateTime->toDateString();
            $logdata['logTime'] = $dateTime->format('H:i:s');
            $logdata['user_id'] = $myuser1->id;
            $logdata['logCode'] = '001';
            $logdata['log_desc'] = 'User Login Successful with username';
            $logdata['Reserved1'] = $myuser1->id;
            $logdata['Reserved2'] = $myuser1->id;
            $logs->insert($logdata);
            return redirect()->intended();

        } elseif ( \Auth::attempt(['email' => $username, 'password' => $password]) ) {
            $logdata = [];
            $dateTime = Carbon::now();
            $logdata['logDate'] = $dateTime->toDateString();
            $logdata['logTime'] = $dateTime->format('H:i:s');
            $logdata['user_id'] = $myuser1->id;
            $logdata['logCode'] = '001';
            $logdata['log_desc'] = 'User login successful with email';
            $logdata['Reserved1'] = $myuser1->id;
            $logdata['Reserved2'] = $myuser1->id;
            $logs->insert($logdata);
            return redirect()->intended();
        }
        elseif ( !empty($myuser1) && $myuser1->username == $username) {

            $logdata = [];
            $dateTime = Carbon::now();
            $logdata['logDate'] = $dateTime->toDateString();
            $logdata['logTime'] = $dateTime->format('H:i:s');
            $logdata['user_id'] = $myuser1->id;
            $logdata['logCode'] = '002';
            $logdata['log_desc'] = 'Login reject with wrong password';
            $logdata['Reserved1'] = $myuser1->id;
            $logdata['Reserved2'] = $myuser1->id;
            $logs->insert($logdata);
            return view('auth.login',['usincorrect' => 'password is incorrect']);

        } elseif(empty($myuser1)) {

            return view('auth.login',['paincorrect' => 'username is incorrect']);

        }

        return view('auth.login',['usincorrect' => 'username & password incorrect']);

    }
}
