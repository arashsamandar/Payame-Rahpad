<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PermissionController as USCC;
use App\Logs;
use App\Content;
use App\ImageOne;
use App\ImageTwo;
use App\ImageThree;
use App\messages as Messages;
use Carbon\Carbon;
use Imgs;

class AjaxContentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }

    public function addContent()
    {
        return view('ajax.AddContent');
    }

    public function AddOneContent(Request $request)
    {
        if ($request->ajax()) {
            return response('success');
        }
    }

    public function saveContent(Request $request)
    {
        if ($request->ajax()) {
            $log_big_image = 0;
            $log_small_image = 0;
            $log_verysmall_image = 0;
            if (\Auth::user()) {
                $user_id = \Auth::user()->id;
            } else {
                $user_id = 0;
            }

            if (USCC::User_have_permission_to_create_content($user_id)) {
                $isconfirmed = 4;
                if(USCC::This_is_Admin_or_ContentManager()) {$isconfirmed = 1;}

                $content = Content::create([

                    'user_id' => $user_id,
                    'title' => $request->input('title'),
                    'brief' => $request->input('brief'),
                    'page_address' => $request->input('page_address'),
                    'input_at' => $request->input('inputat'),
                    'definition' => $request->input('input_definition'),
                    'End_at' => $request->input('end_date'),
                    'Begin_at' => $request->input('start_date'),
                    'created_at' => Carbon::now()->toDateString(),
                    'is_confirmed' => $isconfirmed,

                ]);

                $admin_seen = 0;
                if(PermissionController::This_is_Admin_or_ContentManager()) {
                    $admin_seen = 1;
                }
                if (!empty($request->input('comment'))) {
                    Messages::create([
                        "user_id" => $user_id,
                        "content_id" => $content->id,
                        "admin_message" => $request->input('comment'),
                        "admin_seen" => $admin_seen,
                    ]);
                } else {
                    Messages::create([
                        "user_id" => $user_id,
                        "content_id" => $content->id,
                        "admin_message" => null,
                        "admin_seen" => $admin_seen,
                    ]);
                }

                if ($request->get('user_large_croped_image')) {
                    $imageData = $request->get('user_large_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg', 80);
                    $final_image = base64_encode($img);

                    ImageOne::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imageone' => $final_image,
                    ]);

                    $log_big_image = 1;

                }

                if ($request->get('user_small_croped_image')) {
                    $smallimageData = $request->get('user_small_croped_image');
                    $small_info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $smallimageData));
                    $small_img = Imgs::make($small_info);
                    $small_img->encode('jpg', 80);
                    $small_final_image = base64_encode($small_img);

                    ImageTwo::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imagetwo' => $small_final_image,
                    ]);

                    $log_small_image = 1;

                }


                if ($request->get('user_verysmall_croped_image')) {
                    $verysmallimageData = $request->get('user_verysmall_croped_image');
                    $verysmall_info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $verysmallimageData));
                    $verysmall_img = Imgs::make($verysmall_info);
                    $verysmall_img->encode('jpg', 80);
                    $verysmall_final_image = base64_encode($verysmall_img);

                    ImageThree::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imagethree' => $verysmall_final_image,
                    ]);

                    $log_verysmall_image = 1;

                }

                $sum_of_images = ' content created with ';
                if ($log_big_image == 1) {
                    $sum_of_images .= ' big image ';
                }
                if ($log_small_image == 1) {
                    $sum_of_images .= ' and smaller image ';
                }
                if ($log_verysmall_image == 1) {
                    $sum_of_images .= ' and very small image ';
                }
                $dateTime = Carbon::now();
                Logs::create([
                    'logDate' => $dateTime->toDateString(),
                    'logTime' => $dateTime->format('H:i:s'),
                    'user_id' => $user_id,
                    'logCode' => '014',
                    'log_desc' => $sum_of_images,
                    'Reserved1' => $user_id,
                    'Reserved2' => $user_id,
                ]);

                return response($content);

            } else {
                return response('reject');
            }
        }
    }

    public function editContent(Request $request)
    {
        if ($request->ajax()) {
            if (USCC::ContentsPermission($request->id)) {
                $content = Content::find($request->id);

                if (isset(\DB::table('image_ones')->select('imageone')->where('content_id', '=', $content->id)->first()->imageone)) {
                    $imageData = \DB::table('image_ones')->select('imageone')->where('content_id', '=', $content->id)->first()->imageone;
                } else {
                    $imageData = base64_encode(asset('/public/images/pr.png'));
                }

                if (isset(\DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $content->id)->first()->imagetwo)) {
                    $imageDatasmall = \DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $content->id)->first()->imagetwo;
                } else {
                    $imageDatasmall = base64_encode(asset('public/images/pr.png'));
                }

                if (isset(\DB::table('image_threes')->select('imagethree')->where('content_id', '=', $content->id)->first()->imagethree)) {
                    $imageDataverysmall = \DB::table('image_threes')->select('imagethree')->where('content_id', '=', $content->id)->first()->imagethree;
                } else {

                    $imageDataverysmall = base64_encode(asset(public_path('public/images/pr.png')));
                }
                if (!isset($content->definition)) {
                    $content->definition = '';
                }
                $extra_Information = [];

                $decoded_content_array = json_decode($content, true);
                if(isset($content->messages()->first()->admin_message)) {
                    $extra_Information['admin_message'] = $content->messages()->first()->admin_message;
                }
                if(isset($content->messages()->first()->user_message)) {
                    $extra_Information['user_message'] = $content->messages()->first()->user_message;
                }
                $extra_Information['imageone'] = 'data:image/png;base64,' . $imageData;
                $extra_Information['imagetwo'] = 'data:image/png;base64,' . $imageDatasmall;
                $extra_Information['imagethree'] = 'data:image/png;base64,' . $imageDataverysmall;

                array_push($decoded_content_array, $extra_Information);
                return response($decoded_content_array);
            } else {
                return response('fail');
            }
        }
    }

    public function UpdateContent(Request $request)
    {
        if ($request->ajax()) {
            if (USCC::ContentsPermission($request->id)) {
                $content = Content::find($request->id);
                $contentIsForUser = 0;
                if (isset($content->users()->first()->id)) {
                    $contentIsForUser = $content->users()->first()->id;
                }

                if(\Auth::user()) {
                    $user_id = \Auth::user()->id;
                } else {
                    $user_id = 0;
                }
                $bimage = 0;
                $simage = 0;
                $vsimage = 0;

                if (isset(\DB::table('image_ones')->select('imageone')->where('content_id', '=', $content->id)->first()->imageone)) {
                    if ($request->get('user_large_croped_image')) {
                        \DB::table('image_ones')->where('content_id', '=', $content->id)->delete();
                    }
                }
                if ($request->get('user_large_croped_image')) {

                    $imageData = $request->get('user_large_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg', 80);
                    $final_image = base64_encode($img);

                    ImageOne::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imageone' => $final_image,
                    ]);
                    $bimage = 1;
                }


                if (isset(\DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $content->id)->first()->imagetwo)) {
                    if ($request->get('user_small_croped_image')) {
                        \DB::table('image_twos')->where('content_id', '=', $content->id)->delete();
                    }
                }

                if ($request->get('user_small_croped_image')) {
                    $imageData = $request->get('user_small_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg', 80);
                    $final_image = base64_encode($img);

                    ImageTwo::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imagetwo' => $final_image,
                    ]);
                    $simage = 1;
                }

                if (isset(\DB::table('image_threes')->select('imagethree')->where('content_id', '=', $content->id)->first()->imagethree)) {
                    if ($request->get('user_verysmall_croped_image')) {
                        \DB::table('image_threes')->where('content_id', '=', $content->id)->delete();
                    }
                }
                if ($request->get('user_verysmall_croped_image')) {
                    $imageData = $request->get('user_verysmall_croped_image');
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                    $img = Imgs::make($info);
                    $img->encode('jpg', 80);
                    $final_image = base64_encode($img);

                    ImageThree::create([
                        'content_id' => $content->id,
                        'user_id' => $user_id,
                        'imagethree' => $final_image,
                    ]);
                    $vsimage = 1;
                }

//                $content->is_confirmed = 5;
                $content->definition = $request->input('input_definition');
                $content->update($request->all());


                $sum_of_images = ' content updated ';
                if ($bimage == 1) {
                    $sum_of_images .= ' with big image ';
                }
                if ($simage == 1) {
                    $sum_of_images .= ' and smaller image ';
                }
                if ($vsimage == 1) {
                    $sum_of_images .= ' and very small image ';
                }

                if(!PermissionController::This_is_Admin_or_ContentManager()) {
                    $message = Messages::where('content_id',$content->id);
                    $message->update(['admin_seen' => 0]);
                }

                $dateTime = Carbon::now();

                Logs::create([
                    'logDate' => $dateTime->toDateString(),
                    'logTime' => $dateTime->format('H:i:s'),
                    'user_id' => $user_id,
                    'logCode' => '015',
                    'log_desc' => $sum_of_images,
                    'Reserved1' => $contentIsForUser,
                    'Reserved2' => $user_id,
                ]);

                $color_code = [];
                $color_code['change_denied'] = 0;
                if(!PermissionController::This_is_Admin_or_ContentManager()) {
                    $content = Content::find($request->id);
                    $content->update(['is_confirmed' => 5]);
                    $message = Messages::where('content_id', $request->id);
                    $message->update(['admin_seen' => 0]);
                    $color_code['change_denied'] = 'change_denied';
//                return response('change_denied');
                }

                $decoded_content_array = json_decode($content, true);

                ($content->is_confirmed == 1 ? $color_code['message_color'] = '#e0fde0' : $color_code['message_color'] = '#FFEBE5' );

                array_push($decoded_content_array, $color_code);
                return response($decoded_content_array);
            }
        }
    }

    public function showContentImages(Request $request)
    {
        if ($request->ajax()) {
            if (USCC::ContentsPermission($request->id)) {
                $content = Content::find($request->id); // Learn How Do I pass ID From My Modal Content To The AddContentImage -- To show The Images That User Already Set

                $imageData = \DB::table('image_ones')->select('imageone')->where('content_id', '=', $request->id)->first()->imageone;
                $imageDatasmall = \DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $request->id)->first()->imagetwo;
                $imageDataverysmall = \DB::table('image_threes')->select('imagethree')->where('content_id', '=', $request->id)->first()->imagethree;
                $arr = json_decode($content, true);
                $arrne['imageone'] = 'data:image/png;base64,' . $imageData;
                $arrne['imagetwo'] = 'data:image/png;base64,' . $imageDatasmall;
                $arrne['imagethree'] = 'data:image/png;base64,' . $imageDataverysmall;
                array_push($arr, $arrne);
                return response($arr);
            } else {
                return response('fail');
            }
        }
    }

    public function testFunction()
    {
        $thedefult = asset(public_path('images/Atehran.jpg'));
        $imageData = base64_encode($thedefult);
        dd($imageData);
    }

    public function DestroyContent(Request $request)
    {
        if ($request->ajax()) {
            if (USCC::ContentsPermission($request->id)) {
                if(\Auth::user()) {
                    $user_id = \Auth::user()->id;
                } else {
                    $user_id = 0;
                }
                $content1 = Content::find($request->id);
                $contentBelongsToUser = 0;
                if (isset($content1->users()->first()->id)) {
                    $contentBelongsToUser = $content1->users()->first()->id;
                }
                Content::destroy($content1->id);
                \DB::table('image_ones')->where('content_id', '=', $content1->id)->delete();
                \DB::table('image_twos')->where('content_id', '=', $content1->id)->delete();
                \DB::table('image_threes')->where('content_id', '=', $content1->id)->delete();
                \DB::table('messages')->where('content_id','=',$content1->id)->delete();

                $dateTime = Carbon::now();

                Logs::create([
                    'logDate' => $dateTime->toDateString(),
                    'logTime' => $dateTime->format('H:i:s'),
                    'user_id' => $user_id,
                    'logCode' => '015',
                    'log_desc' => 'content removed',
                    'Reserved1' => $user_id,
                    'Reserved2' => $contentBelongsToUser,
                ]);
                return response(['message' => 'Contact Deleted Successfully']);
            } else {
                return response('fail');
            }
        }
    }

    public function findpage() {
        return DB::table('contents')->selectRaw('contents.id,contents.created_at,contents.title,contents.brief,contents.input_at,contents.page_address,contents.Begin_at,contents.End_at')
            ->paginate(5);
    }

    public function pagination() {
        $contents = $this->findpage();
        return view('ajax.AddContent',compact('contents'));
    }

}