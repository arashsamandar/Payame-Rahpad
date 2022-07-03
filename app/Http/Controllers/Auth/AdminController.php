<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User as User;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public static function adminName() {
        $admin = new Admin();
        return $admin->name;
    }

    public static function adminFamily() {
        $admin = new Admin();
        return $admin->family;
    }

    public function index()
    {
        return view('admin');
    }

    public function findpage()
    {
        return \DB::table('logs')
            ->selectRaw('logs.logid,logs.logDate,logs.logTime,logs.user_id,logs.logCode,logs.log_desc,logs.Reserved1,logs.Reserved2')
            ->paginate(5);
    }

    public function pagination()
    {
        $allLogs = $this->findpage();
        return view('auth.LogsPagination', compact('allLogs'));
    }

    public static function returnUsername($user_id)
    {
        $username = User::find($user_id);
        if (!empty($username)) {
            return $username->username;
        } else if ($username == 0) {
            return 'Admin';
        } else {
            return $user_id;
        }
    }

    public function findUserForPaginate($username)
    {
        $user = User::where('username',$username)->first();
        $user_id = $user->id;

        return \DB::table('logs')
            ->selectRaw('logs.logid,logs.logDate,logs.logTime,logs.user_id,logs.logCode,logs.log_desc,logs.Reserved1,logs.Reserved2')
            ->where('user_id','=', $user_id)
            ->paginate(5)->appends(\Request::except('page'));
    }

    public function searchUsername(Request $request)
    {
        $username = $request->input('contactname');
        if (!empty(\DB::table('users')->selectRaw('users.username')->where('username', '=', $username)->first()->username)) {
            $allLogs = $this->findUserForPaginate($username);
            return view('auth.LogsPagination', compact('allLogs'));
        } else {
            return view('home');
        }
    }
}
