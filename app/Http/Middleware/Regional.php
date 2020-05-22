<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Regional
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 1) {
            return redirect()->route('Overall');
        }

        if (Auth::user()->role == 6) {
            return redirect()->route('Field');
        }

        if (Auth::user()->role == 7) {
            return redirect()->route('Student');
        }

        if (Auth::user()->role == 5) {
            return redirect()->route('Academic');
        }

        if (Auth::user()->role == 4) {
            return redirect()->route('Department');
        }

        if (Auth::user()->role == 3) {
            return redirect()->route('HeadofDepartment');
        }

        if (Auth::user()->role == 2) {
            return redirect()->route('Regional');
        }
    }
}
