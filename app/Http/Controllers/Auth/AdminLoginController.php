<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin as Admin;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.NewAdminLogin');
    }

    public function login(Request $request)
    {

        $this->validate($request,[
          'email' => 'required|email',
          'password' => 'required|min:3',
            ]
        );


        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return view('home');
        } else {
            return redirect()->back()->withInput($request->only('email','remember'));
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('home');
    }
}
