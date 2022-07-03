<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRegisterController extends Controller
{
    public function show_register() {
        $result = Admin::all();
        if (empty($result->all())) {
            return view('auth.admin-register');
        } else {
            return view('auth.NewAdminLogin');
        }
    }

    public function register(Request $request,Admin $admin) {
        $name = $request->input('name');
        $family = $request->input('family');
        $email = $request->input('email');
        $password = $request->input('password');

        $message = array(
            'name.required' => 'نام کاربری را وارد کنید',
            'family.required' => 'رمز عبور را وارد کنید',
            'email.required|email' => 'آدرس پست الکترونیکی را وارد کنید',
            'password.required' => 'رمز عبور را وارد کنید',
        );

        $this->validate(
            $request,
            [
                'name' => 'required',
                'family' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ],$message
        );
        $admin_data = [];
        $admin_data['name'] = $name;
        $admin_data['family'] = $family;
        $admin_data['email'] = $email;
        $admin_data['password'] = bcrypt($password);
        $admin->insert($admin_data);

        return redirect(route('home'));
    }
}
