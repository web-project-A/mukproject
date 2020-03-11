<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class FieldController extends Controller
{

    public function index()
    {
        if(Auth::check()){
            return view('Field.home');
        }else{
            return redirect()->route('login');
        }
    }
}

