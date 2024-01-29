<?php

namespace App\Http\Controllers;

use App\Logs;
use App\Content;
use App\User as User;
use App\messages as Messages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;

class AjaxMessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }

    public function approveOrRemove(Request $request)
    {
        if ($request->ajax()) {
            if (PermissionController::This_is_Admin_or_ContentManager()) {
                if (\Auth::user()) {
                    $signed_id_user_id = \Auth::user()->id;
                } else {
                    $signed_id_user_id = 0;
                }

                $user_message_id = 0;
                if (isset($_POST['this_message_id'])) {
                    $user_message_id = $_POST['this_message_id'];
                    $user_message = Messages::find($user_message_id);
                    $user_content_id = $user_message->contents()->first()->id;
                } elseif ($_POST['this_content_id']) {
                    $user_content_id = $_POST['this_content_id'];
                }
                $check_is_approved = $_POST['approve_Check'];
                $messages = $_POST['area_message'];
                if(isset($_POST['user_message'])) {
                    $user_messages = $_POST['user_message'];
                }

                $user_content = Content::find($user_content_id);

                if ($check_is_approved == 1) {

                    Messages::where('content_id', $user_content_id)->update(['user_message' => $messages,'user_seen' => 0]);
                    $user_content->is_confirmed = 1;
                    $user_content->update();

                    $dateTime = Carbon::now();
                    Logs::create([
                        'logDate' => $dateTime->toDateString(),
                        'logTime' => $dateTime->format('H:i:s'),
                        'user_id' => $signed_id_user_id,
                        'logCode' => '020',
                        'log_desc' => 'Content approved for show',
                        'Reserved1' => $signed_id_user_id,
                        'Reserved2' => $user_content->user_id,
                    ]);


                    $ajax_response['rowid'] = $user_content_id;
                    if(!empty($user_messages)) {
                        $ajax_response['user_messages'] = $user_messages;
                    }
                    $ajax_response['admin_messages'] = $messages;
                    $ajax_response['mid'] = $user_message_id;
                    $ajax_response['check_is_aaproved'] = $check_is_approved;
                    if ($user_message_id != 0) $ajax_response['mrid'] = $user_message_id;
                    $ajax_response['respond'] = 'approved';

                    return response($ajax_response);

                }

                if ($check_is_approved == 2) {

                    Messages::where('content_id', $user_content_id)->update(['user_message' => $messages,'user_seen' => 0]);
                    $user_content->is_confirmed = 0;
                    $user_content->update();
                    $dateTimeTwo = Carbon::now();
                    Logs::create([
                        'logDate' => $dateTimeTwo->toDateString(),
                        'logTime' => $dateTimeTwo->format('H:i:s'),
                        'user_id' => $signed_id_user_id,
                        'logCode' => '021',
                        'log_desc' => 'Content rejected, message sent to user',
                        'Reserved1' => $signed_id_user_id,
                        'Reserved2' => $user_content->user_id,
                    ]);

                    $ajax_response['rowid'] = $user_content_id;
                    if(!empty($user_messages)) {
                        $ajax_response['user_messages'] = $user_messages;
                    }
                    $ajax_response['admin_messages'] = $messages;
                    $ajax_response['mid'] = $user_message_id;
                    if ($user_message_id != 0) $ajax_response['mrid'] = $user_message_id;
                    $ajax_response['respond'] = 'message';

                    return response($ajax_response);

                }

                if ($check_is_approved == 3) {
                    Content::destroy($user_content_id);
                    \DB::table('messages')->where('content_id', $user_content_id)->delete();
                    \DB::table('image_ones')->where('content_id', $user_content_id)->delete();
                    \DB::table('image_twos')->where('content_id', $user_content_id)->delete();
                    \DB::table('image_threes')->where('content_id', $user_content_id)->delete();
                    $dateTimeThree = Carbon::now();
                    Logs::create([
                        'logDate' => $dateTimeThree->toDateString(),
                        'logTime' => $dateTimeThree->format('H:i:s'),
                        'user_id' => $signed_id_user_id,
                        'logCode' => '022',
                        'log_desc' => 'Content Removed',
                        'Reserved1' => $user_content->user_id,
                        'Reserved2' => $signed_id_user_id,
                    ]);
                    $ajax_response['respond'] = 'message';
                    if ($user_message_id != 0) $ajax_response['mrid'] = $user_message_id;
                    if (isset($_POST['table_number'])) {
                        $ajax_response['rowid'] = $user_content_id;
                    }
                    return response($ajax_response);
                } else {
                    return null;
                }
            } {return false;}
        } else {return false;}
    }

    public function approve_or_edit_for_message_page(Request $request)
    {
        if ($request->ajax()) {
            if (PermissionController::This_is_Admin_or_ContentManager()) {
                if (\Auth::user()) {
                    $signed_id_user_id = \Auth::user()->id;
                } else {
                    $signed_id_user_id = 0;
                }

                $user_message_id = $_POST['this_message_id'];
                $user_message = Messages::find($user_message_id);
                $user_content_id = $user_message->contents()->first()->id;

                $check_is_approved = $_POST['approve_Check'];
                $admin_message = $_POST['admin_message'];
                $user_message_text = $_POST['user_message_text'];

                $user_content = Content::find($user_content_id);

                if ($check_is_approved == 1) {

                    Messages::where('content_id', $user_content_id)->update(['user_message' => $admin_message,'user_seen' => 0]);
                    $user_content->is_confirmed = 1;
                    $user_content->update();

                    $dateTime = Carbon::now();
                    Logs::create([
                        'logDate' => $dateTime->toDateString(),
                        'logTime' => $dateTime->format('H:i:s'),
                        'user_id' => $signed_id_user_id,
                        'logCode' => '020',
                        'log_desc' => 'Content approved for show',
                        'Reserved1' => $signed_id_user_id,
                        'Reserved2' => $user_content->user_id,
                    ]);


                    $ajax_response['admin_messages'] = $admin_message;
                    $ajax_response['user_messages'] = $user_message_text;
                    $ajax_response['mid'] = $user_message_id;
                    $ajax_response['check_is_approved'] = $check_is_approved;
                    $ajax_response['respond'] = 'approved';

                    return response($ajax_response);

                }

                if ($check_is_approved == 2) {

                    Messages::where('content_id', $user_content_id)->update(['user_message' => $admin_message,'user_seen' => 0]);
                    $user_content->is_confirmed = 0;
                    $user_content->update();
                    $dateTimeTwo = Carbon::now();
                    Logs::create([
                        'logDate' => $dateTimeTwo->toDateString(),
                        'logTime' => $dateTimeTwo->format('H:i:s'),
                        'user_id' => $signed_id_user_id,
                        'logCode' => '021',
                        'log_desc' => 'Content rejected, message sent to user',
                        'Reserved1' => $signed_id_user_id,
                        'Reserved2' => $user_content->user_id,
                    ]);

                    $ajax_response['admin_messages'] = $admin_message;
                    $ajax_response['user_messages'] = $user_message_text;
                    $ajax_response['mid'] = $user_message_id;
                    $ajax_response['check_is_approved'] = $check_is_approved;
                    $ajax_response['respond'] = 'message';

                    return response($ajax_response);

                }

                if ($check_is_approved == 3) {
                    Content::destroy($user_content_id);
                    \DB::table('messages')->where('content_id', $user_content_id)->delete();
                    \DB::table('image_ones')->where('content_id', $user_content_id)->delete();
                    \DB::table('image_twos')->where('content_id', $user_content_id)->delete();
                    \DB::table('image_threes')->where('content_id', $user_content_id)->delete();
                    $dateTimeThree = Carbon::now();
                    Logs::create([
                        'logDate' => $dateTimeThree->toDateString(),
                        'logTime' => $dateTimeThree->format('H:i:s'),
                        'user_id' => $signed_id_user_id,
                        'logCode' => '022',
                        'log_desc' => 'Content Removed',
                        'Reserved1' => $user_content->user_id,
                        'Reserved2' => $signed_id_user_id,
                    ]);
                    $ajax_response['respond'] = 'message';
                    if ($user_message_id != 0) $ajax_response['mrid'] = $user_message_id;
                    if (isset($_POST['table_number'])) {
                        $ajax_response['rowid'] = $user_content_id;
                    }
                    return response($ajax_response);
                } else {
                    return null;
                }
            } {return false;}
        } else {return false;}
    }

    public function Add_Message_To_admin(Request $request) {
        if($request->ajax()) {
            $content_id = $_POST['this_content_id'];
            $admin_message = $_POST['area_message'];
            $content = Content::find($content_id);
            if(!isset($content->messages()->first()->content_id)) {
                Messages::create([
                    'content_id' => $content_id,
                    'user_id' => $content->messages()->first()->user_id,
                    'admin_message' => $admin_message,
                ]);
                return response('success');
            } else {
                Messages::where('content_id',$content_id)->update(['admin_message' => $admin_message,'admin_seen' => 0]);
                return response('success');
            }
        }
    }

    public static function checkIfApprovedForTR($content_id) {
        $table_Raw_Content_id = Content::find($content_id);
        if($table_Raw_Content_id->is_confirmed == 1) {
            return 1;
        } elseif ($table_Raw_Content_id->is_confirmed == 0) {
            return 0;
        } elseif ($table_Raw_Content_id->is_confirmed == 4) {
            return 4;
        }
    }

    public static function check_the_status_of_content_for_messages_page($message_id) {
        $message = Messages::find($message_id);
        if(!empty($message->contents()->get())) {
            if(isset($message->contents()->first()->is_confirmed)) {
                $content_situation = $message->contents()->first()->is_confirmed;
                $content_id = $message->contents()->first()->id;
                if ($content_situation == 1) {
                    return 'Content approved for show';
                }
                if ($content_situation == 0) {
                    return 'Content Send back to user to get changed';
                }
                if ($content_situation == 4) {
                    $details = 'Content ' . 'with ID Number : ' . $content_id . ' was created by user ' . 'waiting for approval';
                    return $details;
                }
                if($content_situation == 5) {
                    $details = 'Content ' . 'with ID Number : ' . $content_id . ' was changed by user ' . 'waiting for approval';
                    return $details;
                }
            }
        }
    }

    public static function change_message_color($message_id) {
        $message = Messages::find($message_id);
        if(!empty($message->contents()->get())) {
            if(isset($message->contents()->first()->is_confirmed)) {
                $content_situation = $message->contents()->first()->is_confirmed;
                if ($content_situation == 1) {
                    return 1;
                }
                if ($content_situation == 0) {
                    return 2;
                }
            } else {
                return 0;
            }
        }
    }

    public function AdminApproveOrMessageController(Request $request) {
        if($request->ajax()) {
            $message = Messages::find($request->id);
            $message->update(['admin_seen' => 1]);
            $mydata = [];
            $mydata['id'] = $request->id;
            if(isset($message->admin_message)) {
                $mydata['admin_message'] = $message->admin_message;
            }
            if(isset($message->user_message)) {
                $mydata['user_message'] = $message->user_message;
            }
            if(!empty($message->contents()->get())) {
                if($message->contents()->first()->is_confirmed == 1) {
                    $mydata['is_confirmed'] = 1;
                }
                if($message->contents()->first()->is_confirmed == 0) {
                    $mydata['is_confirmed'] = 0;
                }
                if(is_null($message->contents()->first()->is_confirmed)) {
                    $mydata['is_confirmed'] = 2;
                }

            }
            return response($mydata);
        } else {
            return response('fail');
        }
    }

    public function UserMessageController(Request $request) {
        if($request->ajax()) {
            $message = Messages::find($request->id);
            $message->update(['user_seen' => 1]);
            $mydata = [];
            $mydata['id'] = $request->id;
            if(isset($message->admin_message)) {
                $mydata['admin_message'] = $message->admin_message;
            }
            if(isset($message->user_message)) {
                $mydata['user_message'] = $message->user_message;
            }
            return response($mydata);
        } else {
            return response('fail');
        }
    }

    public function find_messages_pagination() {
        return DB::table('messages')->join('users','users.id','=','messages.user_id')
            ->selectRaw('messages.id,messages.content_id,messages.user_message,messages.admin_message,messages.admin_seen,users.name,users.family,users.username')
            ->where('messages.admin_seen','=',0)
            ->orWhere('messages.admin_seen','=',1)
            ->orderBy('users.username')->orderBy('messages.admin_seen')
            ->paginate(5);
    }

    public function show_messages_page() {
        if(PermissionController::This_is_Admin_or_ContentManager()) {
            $messages = $this->find_messages_pagination();
            return view('auth.messagesPage', compact('messages'));
        }
        return redirect(\URL::to('UnAuthorized'));
    }

    public static function check_if_is_for_current_user($message_id) {
        $current_user_message = Messages::find($message_id);
        $user_content_id = $current_user_message->content_id;
        $user_content = Content::find($user_content_id);
        $user_id = $user_content->user_id;
        if($user_id == \Auth::user()->id) {
            return true;
        } else {
            return false;
        }
    }

    public static function Count_unread_admin_messages() {
        $admin_messages_number = Messages::where(['admin_seen' => 0])->get()->count();
        return $admin_messages_number;
    }

    public static function Count_unread_user_message() {
        $admin_messages_number = Messages::where(['user_seen' => 0])->get()->count();
        return $admin_messages_number;
    }

    public function find_user_messages_pagination() {
        return DB::table('messages')
            ->selectRaw('messages.id,messages.user_id,messages.content_id,messages.user_message,messages.admin_message,messages.user_seen')
            ->where('messages.user_id','=',\Auth::user()->id)->paginate(10);
    }

    public function show_user_messages_page() {
        $messages = $this->find_user_messages_pagination();
        return view('auth.userMessagePage', compact('messages'));
    }

    public static function check_the_status_of_contents_for_user_message_page($message_id) {
        $message = Messages::find($message_id);
        if(!empty($message->contents()->get())) {
            if(isset($message->contents()->first()->is_confirmed)) {
                $content_situation = $message->contents()->first()->is_confirmed;
                if ($content_situation == 1) {
                    return 'Message approved for show';
                }
                if ($content_situation == 0) {
                    return 'Edit Message';
                }
                if ($content_situation == 4) {
                    $details = 'Content is waiting for approval';
                    return $details;
                }
                if($content_situation == 5) {
                    $details = 'Your approval request is pending';
                    return $details;
                }
            }
        }
    }

    public function send_user_message(Request $request) {
        if($request->ajax()) {
            $message_id = $_POST['this_message_id'];
            $user_message = $_POST['user_message'];
            $admin_message = $_POST['admin_message'];
            $message = Messages::find($message_id);
            $message->update(['admin_message' => $user_message,'admin_seen' => 0]);
            $respond_array['message_ids'] = $message_id;
            $respond_array['user_messages'] = $user_message;
            $respond_array['admin_messages'] = $admin_message;
            return response($respond_array);
        }
    }

}
