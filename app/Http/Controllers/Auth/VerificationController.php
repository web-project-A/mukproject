<?php

namespace App\Http\Controllers\Auth;

use Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
            case 5:
                $this->redirectTo = '/Academic';
                return $this->redirectTo;
                break;
            case 4:
                $this->redirectTo = '/Department';
                return $this->redirectTo;
                break;
            case 6:
                $this->redirectTo = '/Field';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/HeadofDepartment';
                return $this->redirectTo;
                break;
            case 7:
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
