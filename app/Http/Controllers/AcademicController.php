<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class AcademicController extends Controller
{
   /* public function index()
    {
        return view('Academic.home');
    }*/
    public function index()
    {
        if(Auth::check()){

            return view('Academic.home');
        }else{
            return redirect()->route('login');
        }
    }
}
