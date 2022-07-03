<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public static function adminName() {
        $admin = new Admin();
        return $admin->first()->name;
    }

    public static function adminFamily() {
        $admin = new Admin();
        return $admin->first()->family;
    }
}
