<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;
use App\Placement;
use App\InternshipDetail;
use App\Upload;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function internship()
    {
        $internship = new InternshipDetail();
        $internship->field_supervisor_fname = request('field_supervisor_fname');
        $internship ->field_supervisor_lname = request('field_supervisor_lname');
        $internship->organisation = request('organisation');
        $internship->save();
        return redirect('/Student/InternshipDetails')->with('Success', 'Details have been saved!');
    }

    public function upload(request $request){
        $request->validate([
            'file' => 'required|file|max:3072',  // code to validate size of the file..
        ]);

         if($request->hasFile('file')){

            $filename = $request->file->getClientOriginalName();
            $filesize = $request->file->getClientSize();
            $request->file->storeAs('public/upload', $filename);


             $file = new Upload();
            $file->name = $filename;
            $file->size = $filesize;
            $file->save();

            return redirect('/Student/placementletter')->with('Success', 'File Has been Uploaded');

         }
         return $request->all();
    }


}
