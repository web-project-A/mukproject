<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function student(){
    	return view('pages.student');
    }
    public function field(){
    	return view('pages.field');
    }
    public function academic(){
    	return view('pages.academic');
    }
    public function departmental(){
    	return view('pages.departmental');
    }
    public function regional(){
    	return view('pages.regional');
    }
    public function overrall(){
    	return view('pages.overrall');
    }
    
}
