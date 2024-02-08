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

    use AuthenticatesUsers;


    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view('auth.loginEnglish',['page_title' => 'Enter Application']);
    }

    public function login(Request $request, Logs $logs)
    {

        $username = $request->input('username');
        $password = $request->input('password');


        $message = array(
            'username.required' => 'Username Is Required',
            'password.required' => 'Password Is Required'
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

            return view('auth.loginEnglish',['paincorrect' => 'username is incorrect']);

        }

        return view('auth.loginEnglish',['usincorrect' => 'username & password incorrect']);

    }
}
