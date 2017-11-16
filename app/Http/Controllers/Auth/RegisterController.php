<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/home';

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
             'f_name' => 'required',
             'l_name' => 'required',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
         ]);
     }

     /**
      * Create a new user instance after a valid registration.
      *
      * @param  array  $data
      * @return \App\User
      */


     protected function create(array $data)
     {
         return User::create([
             'first_name' => $data['f_name'],
             'last_name' => $data['l_name'],
             'email' => $data['email'],
             'password' => bcrypt($data['password']),
         ]);
     }
     /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

     public function register(Request $request)
     {
         $data = $request->all();

         // Standard validation
         $this->validator($data)->validate();

         $user = $this->create($data);

         $this->guard()->login($user);

         return $this->registered($request, $user)
                         ? : redirect()->route('home')->with('status','Success registration! Now you are logged in.');
     }
 }
