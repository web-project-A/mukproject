<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function student(){
    	return view('Student.student');
    }
    public function field(){
    	return view('Field.field');
    }
    public function academic(){
    	return view('Academic.academic');
    }
    public function department(){
    	return view('Department.department');
    }
    public function regional(){
    	return view('Regional.regional');
    }
    public function overrall(){
    	return view('Overrall.overrall');
    }
    
}
