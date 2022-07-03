<?php

namespace App\Http\Controllers;

use App\Content;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{


    // If user wants to edit his/her own --( User )-- value or if it is admin or if someone with permission to users
    public static function CheckPermission($user_id) {
        $result = false;
        if(\Auth::user()) {
            if (!empty(User::find(\Auth::user()->id))) {
                $thisUser = User::find(\Auth::user()->id);
                if (!empty($thisUser->permissions()->get())) {
                    if (!empty($thisUser->permissions()->first()->access_users)) {
                        if ($thisUser->permissions()->first()->access_users == 1) {
                            $result = true;
                        } else {
                            $result = false;
                        }
                    } else {
                        $result = false;
                    }
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        if($user_id == \Auth::user()->id || \Auth::guard('admin')->check() || $result == true) {
            return true;
        } else {
            return false;
        }
    }

    // If user wants to edit his/her own --( Content )-- value or if it is admin or if someone with permission to users

    public static function ContentsPermission($content_id) {
         $this_content = Content::find($content_id);
         $contentUserId = $this_content->users()->first()->id;

        $result = false;
        if(\Auth::user()) {
            if (!empty(User::find(\Auth::user()->id))) {
                $thisUser = User::find(\Auth::user()->id);
                if (!empty($thisUser->permissions()->get())) {
                    if (!empty($thisUser->permissions()->first()->access_contents)) {
                        if ($thisUser->permissions()->first()->access_contents == 1) {
                            $result = true;
                        } else {
                            $result = false;
                        }
                    } else {
                        $result = false;
                    }
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        if($contentUserId == \Auth::user()->id || \Auth::guard('admin')->check() || $result == true) {
            return true;
        } else {
            return false;
        }

    }




    public static function User_have_permission_to_create_content($user_id)
    {

        if ($user_id == 0) {
            return true;
        }

        if (!\Auth::guard('admin')->check()) {
            $permit = Permissions::where('user_id', $user_id);
            if (isset($permit->first()->access_contents)) {
                if ($permit->first()->access_contents == 1) {
                    return true;
                }
            }

            $current_user_content = Content::where('user_id',$user_id)->where('is_confirmed',0)->orWhere('is_confirmed',4)->orWhere('is_confirmed',5)->get()->count();
            if ($current_user_content > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }


    public static function This_is_Admin_or_ContentManager() {
        $result = false;
        if(\Auth::user()) {
            if (!empty(User::find(\Auth::user()->id))) {
                $thisUser = User::find(\Auth::user()->id);
                if (!empty($thisUser->permissions()->get())) {
                    if (!empty($thisUser->permissions()->first()->access_contents)) {
                        if ($thisUser->permissions()->first()->access_contents == 1) {
                            $result = true;
                        } else {
                            $result = false;
                        }
                    } else {
                        $result = false;
                    }
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        if(\Auth::guard('admin')->check() || $result == true) {
            return true;
        } else {
            return false;
        }
    }







    // junk probability Remove This Function
    public static function IfIsApproved()
    {
        if(\Auth::user()) {
            if (!empty(User::find(\Auth::user()->id))) {
                $thisUser = User::find(\Auth::user()->id);
                if (!empty($thisUser->permissions()->get())) {
                    if (!empty($thisUser->permissions()->first()->access_contents)) {
                        if ($thisUser->permissions()->first()->access_contents == 1) {
                            return true;
                        }
                    }
                }
            }
        }

        if (\Auth::guard('admin')->check()) {
            return true;
        }

        return false;
    }









}
