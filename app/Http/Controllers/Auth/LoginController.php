<?php

namespace App\Http\Controllers\Auth;


use Auth;


use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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



    function authenticated(Request $request, $user)
    {
        $detail = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($detail, 'Firefox')){
            $browser = 'Mozilla Firefox';
        }elseif(strpos($detail, 'Chrome')){
           $browser = 'Google Chrome';
        }elseif(strpos($detail, 'Opera') || strpos($detail, 'OPR/')){
           $browser = 'OperaMini';
        }elseif(strpos($detail, 'Safari')){
           $browser = 'Safari';
        }elseif(strpos($detail, 'Egde')){
           $browser = 'Microsoft Edge';
        }elseif(strpos($detail, 'MSIE') || strpos($detail, 'Trident/7')){
           $browser = 'Internet Explorer';
        }else 
           $browser = 'Other';

        if(preg_match('/linux/i', $detail)){
           $platform = 'Linux';
        }else if(preg_match('/macintosh|mac os x/i', $detail)){
           $platform = 'Macintosh';
        }else if(preg_match('/windows|win32/i', $detail)){
           $platform = 'Windows';
        }else if(preg_match('/android/i', $detail)){
            $platform = 'Android';
         }else 
            $platform = 'Other';
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp(),
            'Device_Browser' => $browser,
            'Device_platform' => $platform,

        ]);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');


    }
}
