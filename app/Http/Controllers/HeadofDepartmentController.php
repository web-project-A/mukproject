<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadofDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
            return view('Head_of_Department.home');

    }
}
