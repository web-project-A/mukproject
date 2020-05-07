<?php

namespace App\Http\Controllers\Auth;


use Auth;
use App\Location;

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
        $user = Auth::user();
        $user_id = $user->id;
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
        $ip_address = file_get_contents('https://api.ipify.org?format=json'); // use if connected 
        $ip_address = json_decode($ip_address);                               //to network to get real IP
        foreach($ip_address as $key => $value){
            $realip = $value;
        } 
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'Device_Browser' => $browser,
            'Device_platform' => $platform,
            //'last_login_ip' => $request->ip(),  // use if on localhost  
            'last_login_ip' =>  $realip,        // use if online
        ]);

        $urlTemp = 'http://ip-api.com/json';
        $Json = file_get_contents($urlTemp);
        $geoLocation = json_decode($Json, true );
       
         foreach($geoLocation as $key => $value){
               if($key == 'country'){
                $country = $value;
              }if($key == 'countryCode'){
                  $countryCode = $value;
              }if($key == 'regionName'){
                  $regionName = $value;
              }if($key == 'city'){
                  $city = $value;
              }if($key == 'lat'){
                  $latitude = $value;
              }if($key == 'lon'){
                  $longitude = $value;
              }if($key == 'timezone'){
                  $timezone = $value;
              }
         }
         $location = new Location();
         $location->ip_addr =  $realip;
         $location->user_id = $user_id;
         $location->country  = $country;
         $location->countryCode = $countryCode;
         $location->regionName = $regionName;
         $location->city = $city;
         $location->lat = $latitude;
         $location->lon  = $longitude;
         $location->timezone = $timezone;
         $location->save();
        
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
