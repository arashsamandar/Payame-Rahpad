<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Logs;
use App\UserImages;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Imgs;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->request = $request;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm() {
        return view('auth.registerEnglish');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:25',
            'family' => 'required|max:25',
            'password' => 'required|max:25|confirmed',
            'email' => 'required|email|max:40|unique:users',
            'username' => 'required|unique:users',
            'userimage' => 'image|mimes:jpeg,png,jpg,svg|max:6000',
        ],
            [
                'name.required' => 'name is required',
                'name.max' => 'maximum character 25',


                'userimage.image' => 'valid image formats : jpg jpeg png',
                'userimage.mimes' => 'valid images : jpg jpeg png',

                'family.required' => 'family is required',
                'family.max' => 'maximum character 25',

                'username.required' => 'username is required',
                'username.unique' => 'username already taken',

                'password.required' => 'please enter password',
                'password.confirmed' => 'password confirmation is wrong',
                'password.max' => 'maximum character 25',

                'email.required' => 'email address is required',
                'email.unique' => 'email address already taken',
                'email.email' => 'not a valid email address',
                'email.max' => 'maximum character 40'

            ]);
    }

    protected function register(Request $request)
    {
        $data = $request->all();

        $validation = $this->validator($data);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $dateTime = Carbon::now();
        $user = User::create([
            'name' => $data['name'],
            'family' => $data['family'],
            'username' =>$data['username'],
            'password' => bcrypt($data['password']),
            'email' => $data['email']
        ]);

        if($this->request->get('image-data')) {
            $imageData = $this->request->get('image-data');
            $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
            $img = Imgs::make($info);
            $img->encode('jpg',80);
            $final_image = base64_encode($img);

            UserImages::create([
                'user_id' => $user->id,
                'image' => $final_image,
            ]);
        }

        //_____________________End Saving user image___________________

        Logs::create([
            'logDate' => $dateTime->toDateString(),
            'logTime' => $dateTime->format('H:i:s'),
            'user_id' => $user->id,
            'logCode' => '010',
            'log_desc' => 'User created successfully',
            'Reserved1' => $user->id,
            'Reserved2' => $user->id,
        ]);

        \Auth::logout();

        return $user;

    }
}
