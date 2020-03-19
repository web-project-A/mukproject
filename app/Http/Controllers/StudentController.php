<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

use App\Student;
use App\Placement;
use App\Region;
use DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('Student.home');
    }

    public function show()
    {
        $student = Auth::user();
        $regions = DB::table('regions')->groupBy('region')->get();
        return view('Student.placementDetails', compact('student', 'regions'));
    }

    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('regions')->where($select, $value)->groupBy($dependent)->get();
        $output = '<option value="">Select'.ucfirst($dependent).'</option>';
        foreach($data as $row){
            $output.='<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }

    public function placement(Request $request, $std_number)
    {
        $validate = $request->validate([
            'field_supervisor_fname' => 'required|string|max:255',
            'field_supervisor_other' => 'required|string|max:255',
            'organisation' => 'required|string|max:255',
            'contact' => 'required|min:10|max:10',
            'email' => 'required|email|string|max:255'
        ]);


        $fname = $request->input('field_supervisor_fname');
        $other = $request->input('field_supervisor_other');
        $org = $request->input('organisation');
        $field_others = DB::select("select field_supervisor_other from placements where field_supervisor_fname='$fname' and organisation='$org'"); 
        foreach($field_others as $field_other)
        {
            //dd($field_other->field_supervisor_other);
            if($field_other->field_supervisor_other == $other) {
                DB::update("update students set organisation=?, field_supervisor_fname=?, field_supervisor_other=? where std_number=?", [$org, $fname, $other, $std_number]);
            }else {
                DB::update("update students set organisation=?, field_supervisor_fname=?, field_supervisor_other=? where std_number=?", [$org, $fname, $other, $std_number]);
    
                $placement = new Placement();
                $placement->field_supervisor_fname = request('field_supervisor_fname');
                $placement->field_supervisor_other = request('field_supervisor_other');
                $placement->start_date = request('start_date');
                $placement->end_date = request('end_date');
                $placement->organisation = request('organisation');
                $placement->address = request('address');
                $placement->additional_add_info = request('additional_information');
                $placement->region = request('region');
                $placement->city = request('city');
                $placement->phone_number = request('contact');
                $placement->email = request('email');
                $placement->save();
            }
            
        }
    }
}
