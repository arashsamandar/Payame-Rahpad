<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Imgs;


class ImageController extends Controller
{
    public function __construct(Request $request)
    {
//        $this->request = $request; ----------------- In Case Of ERROR Uncomment Me ---------------------------------
    }

    public function showimage($id) {
        $imageData = \DB::table('user_images')->select('image')->where('user_id','=',$id)->first()->image;
        $info = $info = base64_decode($imageData);
        $img = Imgs::make($info);
        $img->encode('jpg',80);
        return $img;
    }

    public function showimageform()
    {
        $imagetype = ['.jpg', '.jpeg', '.png'];
        return view('imageform', ['imagetypes' => $imagetype]);
    }

    public function processimageform()
    {
        $rules = array(
            'image' => 'required|mimes:jpeg,jpg|max:10000'
        );

        $validation = \Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return \Redirect::action('ImageController@showimageform')->withErrors($validation);
        } else {
            $file = $this->request->file('image');
            $file_name = $file->getClientOriginalName();
            if ($file->move('images', $file_name)) {
                return view('jcrop', ['image' => 'images/' . $file_name]);
            } else {
                return "Error uploading file";
            }
        }
    }

    public function showjcrop()
    {
        return view('jcrop', ['image' => '/images' . Session::get('image')]);
    }

    public function jcropprocess()
    {

        $src = Input::get('image');
        $img = imagecreatefromjpeg($src);
        $dest = ImageCreateTrueColor(Input::get('w'),
            Input::get('h'));

            imagecopyresampled($dest, $img, 0, 0, Input::get('x'),
            Input::get('y'), Input::get('w'), Input::get('h'),
            Input::get('w'), Input::get('h'));

        return "<img src='" . $src . "'>";
    }

    public function cropimages()
    {
        $file = $_FILES['file']['tmp_name'];
        \Storage::disk('uploads')->put('havij.jpg', \File::get($file));
        return response($file);
        $mytype = $file->getClientOriginalExtension();

    }

    public function showcropimages()
    {
        return view('crop');
    }

    public static function checkContent_Image_Number()
    {
        //-------------------------- Warning ------------------------
        //---- This Is Not The Correct Way Of How Relations Work In Laravel -----
        $dateTime = Carbon::now();
        $contents_querybuiler_array = \DB::table('contents')
            ->select('id', 'title', 'brief', 'page_address')
            ->where('input_at', '=', 1)->where('is_confirmed','=',1)
            ->where('End_at', '>=', $dateTime->toDateString())
            ->get(); // Where Image Should Be ( Look in the Content Table )
        $arr = [];
        foreach ($contents_querybuiler_array as $objectType) {
            if (isset(\DB::table('image_ones')->select('imageone')->where('content_id', '=', $objectType->id)->first()->imageone)) {
                $arr[0][] = $objectType->id;
                $arr[1][] = $objectType->title;
                $arr[2][] = $objectType->brief;
                $arr[3][] = 'data:image/png;base64,' . \DB::table('image_ones')->select('imageone')->where('content_id', '=', $objectType->id)->first()->imageone;
                $arr[4][] = $objectType->page_address;
            }
        }
        return $arr;
    }

    public static function checkContent_Image_Number_Bellow_Slider()
    {

        $dateTime = Carbon::now();
        //-------------------------- Warning ------------------------
        //---- This Is Not The Correct Way Of How Relations Work In Laravel -----
        $contents_querybuiler_array = \DB::table('contents')
            ->select('id', 'title', 'brief', 'page_address')
            ->where('input_at', '=', 2)->where('is_confirmed','=',1)
            ->where('End_at', '>=', $dateTime->toDateString())
            ->get();

        $arr = [];
        // ------ Bellow Check Both Image_Twos & Image_Ones Table To Get The relevant image whether it is in image_one table or image_two
        foreach ($contents_querybuiler_array as $objectType) {
            if (isset(\DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $objectType->id)->first()->imagetwo)) {
                $arr[0][] = $objectType->id;
                $arr[1][] = $objectType->title;
                $arr[2][] = $objectType->brief;
                $arr[3][] = 'data:image/png;base64,' . \DB::table('image_twos')->select('imagetwo')->where('content_id', '=', $objectType->id)->first()->imagetwo;
                $arr[4][] = $objectType->page_address;
            } else if (isset(\DB::table('image_ones')->select('imageone')->where('content_id', '=', $objectType->id)->first()->imageone)) {
                $arr[0][] = $objectType->id;
                $arr[1][] = $objectType->title;
                $arr[2][] = $objectType->brief;
                $arr[3][] = 'data:image/png;base64,' . \DB::table('image_ones')->select('imageone')->where('content_id', '=', $objectType->id)->first()->imageone;
                $arr[4][] = $objectType->page_address;
            }
        }
        return $arr;
    }

    // ------------------------------------------------ New Ones After Methadone 1402/11/15 ----------------------------------------------------

    public static function return_global_imageIterator_bellowSlider_forAjax(){
        return self::checkContent_Image_Number_Bellow_Slider();
    }

    public static function ajaxTestsOne(){
        $myArray = ['arash','salamander','havij'];
        return $myArray;
    }
    public static function testAjax(){
        return self::ajaxTestsOne();
    }

}