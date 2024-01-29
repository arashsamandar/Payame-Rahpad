<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;



use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Logs;
use Validator;
use Illuminate\Http\UploadedFile;
use Imgs;
use App\User;
use App\UserImages;

class UserUpdateController extends Controller
{

    public function __construct(Request $request)
    {

        $this->request = $request;

    }

    public function updatepass() {
        $imagetype = ['.jpg','.jpeg','.png'];
        return view('Layouts.changepass',['imagetypes' => $imagetype]);
    }

    public function changepass() {
        $pass = $this->request->get('password');
        $passconf = $this->request->get('password_confirmation');

        if(trim($pass) === trim($passconf)) {
            \Auth::user()->password = \Hash::make($pass);
            \Auth::user()->save();
            \Auth::logout();
            return redirect('login');
        } else {
            return false;
        }
    }


    public function showUpdate() {
        $imagetype = ['.jpg','.jpeg','.png'];
        return view('auth.update',['imagetypes' => $imagetype]);
    }


    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:25',
            'family' => 'required|max:25',
            'email' => 'required|email|max:40',
            'birth_date' => 'required|date',
            'national_code' => 'required|numeric|max:9999999999',
            'gender' => 'required|max:4',
            'cell_phone' => 'required|numeric|max:99999999999',
            'userimage' => 'image|mimes:jpeg,png,jpg|max:2048'
        ],
            [
                'name.required' => 'name is required',
                'name.max' => 'cant be more than 25 characters long',

                'family.required' => 'family is required',
                'family.max' => 'cant be more than 25 characters long',

                'birth_date.required' => 'birth-date is required',
                'birth_date.date' => 'birth-date invalid format',

                'national_code.required' => 'national code is required',
                'national_code.unique' => 'national code already taken',
                'national_code.max' => 'national code cant be more than 10 characters long',
                'national_code.numeric' => 'national code cant have letters',

                'cell_phone.required' => 'phone number is required',
                'cell_phone.numeric' => 'phone number cant have letters',
                'cell_phone.max' => 'phone number cant be more than 11 numbers',

                'gender.max' => 'gender cant be more than 4 characters',
                'gender.required' => 'gender is required',

                'email.required' => 'email address is required',
                'email.unique' => 'email address already taken',
                'email.email' => 'email address format invalid',
                'email.max' => 'too long, cant be more than 40 characters long',

                'userimage.max' => 'file size too large',
                'userimage.image' => 'valid image formats : jpg jpeg png',
                'userimage.mimes' => 'valid images : jpg jpeg png',

            ]);

        \Auth::user()->name = $request->input('name');
        \Auth::user()->family = $request->input('family');
        \Auth::user()->birth_date = $request->input('birth_date');
        \Auth::user()->gender = $request->input('gender');
        \Auth::user()->national_code = $request->input('national_code');
        \Auth::user()->cell_phone = $request->input('cell_phone');
        \Auth::user()->email = $request->input('email');

        if($this->request->get('image-data')) {
            $checkforimage = UserImages::selectuserimage(\Auth::user()->id);
            if($checkforimage) {
                $imageData = $this->request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg', 80);
                $final_image = base64_encode($img);

                $userimage = UserImages::find(\Auth::user()->id);
                $userimage->user_id = \Auth::user()->id;
                $userimage->image = $final_image;
                $userimage->update();

            } else {

                $images = \DB::table('user_images')->where('user_id','=',\Auth::user()->id)->delete();

                $imageData = $this->request->get('image-data');
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
                $img = Imgs::make($info);
                $img->encode('jpg', 80);
                $final_image = base64_encode($img);

                UserImages::create([
                    'user_id' => \Auth::user()->id,
                    'image' => $final_image,
                ]);
            }

        }


        \Auth::user()->save();

        $dateTime = Carbon::now();
        Logs::create([
            'logDate' => $dateTime->toDateString(),
            'logTime' => $dateTime->format('H:i:s'),
            'user_id' => \Auth::user()->id,
            'logCode' => '011',
            'log_desc' => 'User updated his/her information',
            'Reserved1' => \Auth::user()->id,
            'Reserved2' => \Auth::user()->id,
        ]);

        $imagetype = ['.jpg','.jpeg','.png'];
        return view('home',['imagetypes' => $imagetype]);

    }

}
