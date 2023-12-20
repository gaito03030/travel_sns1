<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        
        return User::create([
            'icon_url' => "default_icon.jpg",
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_flg' => 1,
            'bio' => null,
            'web_url' => null
        ]);
    }

    public function show(){
        return view('register_company');
    }

    //company_flgで企業だった場合の処理
    //company_flg = 0が企業側
    public function showCompanyRegistrationForm(Request $request)
    {

        $user = new User;
        $user->icon_url = "default_icon.jpg";
        $user->name = $request->input('name');
        $user->email= $request->input('email');
        $user->password= Hash::make($request->input('password'));
        $user->company_flg = 0;
        $user->bio = null;
        $user->web_url = null;

        $user->save();
        
        //  User::create([
        //     'icon_url' => "default_icon.jpg",
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        //     'company_flg' => 0,
        //     'bio' => '',
        //     'web_url' => ''
        // ]);
             
    }

    public function redirectPath()
    {
        $user = auth()->user()->company_flg;
        if($user == 0){
            return 'company_mypage';
        }else{
            return 'timeline';
        }
        //例）return 'costs/index';
    }
  
}
