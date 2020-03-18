<?php

namespace App\Http\Controllers\Auth;


use Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
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

    protected $redirectTo;

    public function redirectTo()
    {
        switch(Auth::user()->role){
            case 2:
            $this->redirectTo = '/Regional';
            return $this->redirectTo;
                break;
            case 4:
                    $this->redirectTo = '/Academic';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/Department';
                return $this->redirectTo;
                break;
            case 5:
                    $this->redirectTo = '/Field';
                return $this->redirectTo;
                break;
            case 6:
                $this->redirectTo = '/Student';
                return $this->redirectTo;
                break;
            case 1:
                $this->redirectTo = '/Overall';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
         
        // return $next($request);
    } 

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
            'fname' => ['required', 'string', 'max:255'],
            'other' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'std_number' => ['required', 'string', 'max:255'],
            'reg_number' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:10', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'fname' => $data['fname'],
            'other' => $data['other'],
            'user_type' => $data['user_type'],
            'std_number' => $data['std_number'],
            'reg_number' => $data['reg_number'],
            'gender' => $data['gender'],
            'number' => $data['number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
