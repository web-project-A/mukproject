<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverallController extends Controller
{
    public function index()
    {
        return view('Overall.home');
    }
}
