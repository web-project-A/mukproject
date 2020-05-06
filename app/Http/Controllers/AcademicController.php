<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
   public function index()
    {
        return view('Academic.home');
    }

}
