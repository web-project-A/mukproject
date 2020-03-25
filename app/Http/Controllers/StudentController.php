<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Student;
use App\Placement;
use App\Region;
use App\Daily_journal;
use App\InternshipDetail;
use App\Upload;
use App\Report;

use DB;


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

    public function show()
    {
        $student = Auth::user();
        $regions = DB::table('regions')->groupBy('region')->get();
        return view('Student.placementDetails', compact('student', 'regions'));
    }

    public function fetch(Request $request)
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
            'contact' => 'required|min:9|max:14',
            'email' => 'required|email|string|max:255'
        ]);

        $fname = $request->input('field_supervisor_fname');
        $other = $request->input('field_supervisor_other');
        $org = $request->input('organisation');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $field_others = DB::select("select field_supervisor_other from placements where field_supervisor_fname='$fname' and organisation='$org'");
        //dd($field_others);
        if(!empty($field_others))
        {
            DB::update("update students set organisation=?, field_supervisor_fname=?, field_supervisor_other=?, start_date=?, end_date=? where std_number=?", [$org, $fname, $other, $start, $end, $std_number]); 
        } else {
            DB::update("update students set organisation=?, field_supervisor_fname=?, field_supervisor_other=?, start_date=?, end_date=? where std_number=?", [$org, $fname, $other, $start, $end, $std_number]);
    
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
        $request->session()->flash('Success', 'Details have been saved!');
        return redirect()->back();
    }

    public function logbook()
    {
        $student = DB::table('students')->get();
        $organisation = DB::table('placements')->get();
        return view('Student.dailyJournal', compact('student', 'organisation'));
    }

    public function fillJournal(Request $request, $std_number)
    {
        $validate = $request->validate([
            'field_supervisor_fname' => 'required|string|max:255',
            'field_supervisor_other' => 'required|string|max:255',
            'academic_supervisor_fname' => 'required|string|max:255',
            'academic_supervisor_other' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'other_name' => 'required|string|max:255',
            'org_name' => 'required|string|max:255',
            'org_address' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255',
            'number' => 'required|min:9|max:14',
            'org_number' => 'required',
            'email' => 'required|email|string|max:255'
        ]);

        $fill = new Daily_journal();
        $fill->std_number = $std_number;
        $fill->reg_number = $request['reg_number'];
        $fill->course = $request['course'];
        $fill->fname = $request['fname'];
        $fill->other_name = $request['other_name'];
        $fill->phoneCode = $request['phoneCode'];
        $fill->number = $request['number'];
        $fill->email = $request['email'];
        $fill->organisation = $request['org_name'];
        $fill->org_address = $request['org_address'];
        $fill->org_number = $request['org_number'];
        $fill->field_supervisor_fname = $request['field_supervisor_fname'];
        $fill->field_supervisor_other = $request['field_supervisor_other'];
        $fill->academic_supervisor_fname = $request['academic_supervisor_fname'];
        $fill->academic_supervisor_other = $request['academic_supervisor_other'];
        $fill->save();

        $request->session()->flash('Success', 'Details have been saved!');
        return redirect()->back();   
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

    public function upload(request $request)
    {
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

    public function report()
    {
        $student = Auth::user();
        return view('Student.weeklyReport', compact('student'));
    }

    public function fillReport(Request $request, $std_number)
    {
        $report = new Report();
        $report->std_number = $std_number;
        $report->date = $request['date'];
        $report->week_number = $request['wk_number'];
        $report->task_completed = $request['task_completed'];
        $report->task_in_progress = $request['task_in_progress'];
        $report->next_day_tasks = $request['next_day_tasks'];
        $report->problems = $request['problems'];
        $report->save();

        $request->session()->flash('Success', 'Details have been saved!');
        return redirect()->back();   
    }


}
