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
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:25',
            'family' => 'required|max:25',
            'password' => 'required|confirmed',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'birth_date' => 'required|date',
            'national_code' => 'required|unique:users|numeric|max:9999999999',
            'gender' => 'required|max:4',
            'cell_phone' => 'required|numeric|max:99999999999',
            'userimage' => 'image|mimes:jpeg,png,jpg,svg|max:6000',
        ],
            [
                'name.required' => 'name is required',
                'name.max' => 'maximum character 25',


                'userimage.image' => 'valid image formats : jpg jpeg png',
                'userimage.mimes' => 'valid images : jpg jpeg png',

                'family.required' => 'family is required',

                'username.required' => 'username is required',
                'username.unique' => 'username already taken',

                'birth_date.required' => 'birth-date is required',
                'birth_date.date' => 'date format is incorrect',

                'national_code.required' => 'national code is neccesary',
                'national_code.unique' => 'national code already taken',
                'national_code.max' => 'national code cant be more than 10 characters long',
                'national_code.numeric' => 'national code cant have symbols or letters',

                'cell_phone.required' => 'phone number is required',
                'cell_phone.numeric' => 'phone number cant have letters',
                'cell_phone.max' => 'phone number cant be more than 11 numbers',

                'gender.max' => 'gender cant be more than 4 letters',
                'gender.required' => 'gender is required',

                'password.required' => 'please enter password',
                'password.confirmed' => 'password confirmation is wrong',

                'email.required' => 'email address is required',
                'email.unique' => 'email address already taken',
                'email.email' => 'not a valid email address',

            ]);
    }

    protected function create(array $data)
    {
        $dateTime = Carbon::now();
        $user = User::create([
            'name' => $data['name'],
            'family' => $data['family'],
            'national_code' => $data['national_code'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'username' =>$data['username'],
            'password' => bcrypt($data['password']),
            'cell_phone' => $data['cell_phone'],
            'email' => $data['email'],
            'created_at_shamsi' => $dateTime->toDateString(),
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
