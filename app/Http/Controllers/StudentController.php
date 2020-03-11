<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;
use App\Placement;

class StudentController extends Controller
{
    public function index()
    {
        return view('Student.home');
    }

    public function placement()
    {
        $placement = new Placement();
        $placement->field_supervisor_fname = request('field_supervisor_fname');
        $placement->field_supervisor_lname = request('field_supervisor_lname');
        $placement->organisation = request('organisation');
        $placement->start_date = request('start_date');
        $placement->end_date = request('end_date');
        $placement->save();
        return redirect('/Student/placementDetails')->with('Success', 'Details have been saved!');
    }

    public function org()
    {
        $org = new Organisation();
        $org->address = request('address');
        $org->added_address_info = request('additional_information');
        $org->region = request('region');
        $org->city = request('city');
        $org->contact = request('contact');
        $org->email = request('email');
        $org->save();
        return redirect('/Student/placementDetails')->with('Success', 'Details have been saved!');
    }
}
