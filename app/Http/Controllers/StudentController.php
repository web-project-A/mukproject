<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\Registration;
use Illuminate\Support\Facades\Mail;


use App\Student;
use App\Organisation;
use App\Region;
use App\Daily_journal;
use App\Field_supervisor;
use App\Upload;
use App\Report;

use DB;
use File;
use Storage;
use Response;



class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $uploads = DB::select("select * from uploads where user_id=$user_id");
        if(!empty($uploads))
        {
            $upload_check = 'checked';
        }else{
            $upload_check = '';
        }

        $placementDetails = DB::select("select * from students where user_id=$user_id");
        foreach($placementDetails as $placementDetail){
            $start_date = $placementDetail->start_date;
        }
        if($start_date != null)
        {
            $placement_check = 'checked';
        }else{
            $placement_check = '';
        }

        $dailyJournals = DB::select("select * from daily_journals where user_id=$user_id");
        if(!empty($dailyJournals))
        {
            $daily_check = 'checked';
        }else{
            $daily_check = '';
        }

        $reports = DB::select("select count(user_id) as number from reports where user_id=$user_id");
        foreach($reports as $report)
        {
            $report_number = $report->number;
        }
        
        $file = DB::table('uploads')->where('user_id', '=', $user_id)->get();
        $upload = DB::table('uploads')->where('user_id', '=', $user_id)->get();
        $display = DB::table('uploads')->where('user_id', '=', $user_id)->get();

        return view('Student.home', compact('upload_check', 'user', 'placement_check', 'daily_check', 'report_number','file','upload','display'));
    }
    
    public function viewplacement()
    {
        $user = Auth::user();
        $file = DB::table('uploads')->get();
        $upload = DB::table('uploads')->get();
        $display = DB::table('uploads')->get();
        return view('Student.viewplacement', compact('user', 'file', 'upload', 'display'));
    }

    public function show()
    {
        $student = Auth::user();
        $regions = DB::table('regions')->groupBy('region')->get();
        $student_id = $student->id;
        $dates = DB::select("select * from students where user_id=$student_id");
        foreach($dates as $date)
        {
            $start_date = $date->start_date;
            $end_date =$date->end_date;
        }
        //dd($start_date);
        if($start_date == null)
        {
            return view('Student.placementDetails', compact('student', 'regions'));
        }else{
            $studs = DB::select("select * from students where user_id=$student_id");
            foreach($studs as $stud)
            {
                $org_id = $stud->org_id;
                $field_supervisor_id = $stud->field_supervisor_id;
            }
            $fields = DB::select("select * from field_supervisors where id=$field_supervisor_id");
            $orgs = DB::select("select * from organisations where id=$org_id");
            return view('Student.placementDetailsEdit', compact('student', 'studs', 'fields', 'orgs'));
        }
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('regions')->where($select, $value)->groupBy($dependent)->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row){
            $output.='<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }

    public function placement(Request $request, $id)
    {
        $validate = $request->validate([
            'field_supervisor_fname' => 'required|string|max:255',
            'field_supervisor_other' => 'required|string|max:255',
            'organisation' => 'required|string|max:255',
            'contact' => 'required|min:9|max:14',
            'phonenumber' => 'required|min:9|max:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'email' => 'required|email|string|max:255'
        ]);

        $phoneCode = $request['phoneCode'];
        $phonenumber = $request['phonenumber'];
        $phonenumber = $phoneCode . $phonenumber;

        $fname = $request->input('field_supervisor_fname');
        $other = $request->input('field_supervisor_other');
        $field_email = $request->input('field_email');
        $address = $request->input('address');
        $org_name = $request->input('organisation');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $orgs = DB::select("select * from organisations where address='$address' and name='$org_name'");
        //dd($field_others);
        if(!empty($orgs))
        {
            foreach($orgs as $org){
                $org_id = $org->id;
            }
            $fields = DB::select("select * from field_supervisors where fname='$fname' and org_id=$org_id");
            if(!empty($fields))
            {
                foreach($fields as $field){
                    $field_supervisor_id = $field->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $field_supervisor_id, $start, $end, $id]);
                
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }else{
                foreach($orgs as $org){
                    $org_id = $org->id;
                }

                $field_supervisor = new Field_supervisor();
                $field_supervisor->fname = $fname;
                $field_supervisor->other = $other;
                $field_supervisor->phonenumber = $phonenumber;
                $field_supervisor->field_email = $field_email;
                $field_supervisor->org_id = $org_id;
                $field_supervisor->save();

                Mail::to($field_email)->send(new Registration());
                //dd($field_email);

                $fieldsups = DB::select("select * from field_supervisors where fname='$fname' and org_id=$org_id");
                foreach($fieldsups as $fieldsup){
                    $fieldsup_id = $fieldsup->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $fieldsup_id, $start, $end, $id]);

                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }
        }
        else
        {
            $organisation = new Organisation();
            $organisation->name = $org_name;
            $organisation->address = $address;
            $organisation->additional_address_info = request('additional_information');
            $organisation->region = request('region');
            $organisation->town = request('town');
            $organisation->phonenumber = request('contact');
            $organisation->email = request('email');
            $organisation->save();

            $organs = DB::select("select * from organisations where address='$address' and name='$org_name'");
            foreach($organs as $organ){
                $organ_id = $organ->id;
            }

            $fieldsupervisors = DB::select("select * from field_supervisors where fname='$fname' and other='$other'");
            if(!empty($fieldsupervisors)){
                foreach($fieldsupervisors as $fieldsupervisor){
                    $fieldsupervisor_id = $fieldsupervisor->id;
                }
                DB::update("update field_supervisors set org_id=? where fname=? and other=?", [$organ_id, $fname, $other]);
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$organ_id, $fieldsupervisor_id, $start, $end, $id]);
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }else{
                $field_supervisor = new Field_supervisor();
                $field_supervisor->fname = $fname;
                $field_supervisor->other = $other;
                $field_supervisor->phonenumber = $phonenumber;
                $field_supervisor->field_email = $field_email;
                $field_supervisor->org_id = $organ_id;
                $field_supervisor->save();

                Mail::to($field_email)->send(new Registration());
                //dd($field_email);

                $field_sups = DB::select("select * from field_supervisors where fname='$fname', other='$other' and org_id=$organ_id");
                foreach($field_sups as $field_sup){
                    $field_sup_id = $field_sup->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $field_sup_id, $start, $end, $id]);

                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }
        }
    }

    public function placementedit(Request $request, $id)
    {
        $validate = $request->validate([
            'field_supervisor_fname' => 'required|string|max:255',
            'field_supervisor_other' => 'required|string|max:255',
            'organisation' => 'required|string|max:255',
            'contact' => 'required|min:9|max:14',
            'phonenumber' => 'required|min:9|max:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'email' => 'required|email|string|max:255'
        ]);

        $fname = $request->input('field_supervisor_fname');
        $other = $request->input('field_supervisor_other');
        $phonenumber = $request->input('phonenumber');
        $field_email = $request->input('field_email');
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $org_name = $request->input('organisation');
        $address = $request->input('address');
        $additional = $request->input('additional_information');
        $region = $request->input('region');
        $town = $request->input('town');
        $number = $request->input('contact');
        $email = $request->input('email');

        $studs = DB::select("select * from students where user_id=$id");
        foreach($studs as $stud)
        {
            $org_id = $stud->org_id;
            $field_id = $stud->field_supervisor_id;
        }

        $orgs = DB::select("select * from organisations where address='$address' and name='$org_name'");
        if(!empty($orgs))
        {
            foreach($orgs as $org){
                $org_id = $org->id;
            }
            $fields = DB::select("select * from field_supervisors where field_email='$field_email' and org_id=$org_id"); 
            if(!empty($fields))
            {
                foreach($fields as $field){
                    $field_supervisor_id = $field->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $field_supervisor_id, $start, $end, $id]);
                DB::update("update field_supervisors set fname=?, other=?, phonenumber=? where field_email=?", [$fname, $other, $phonenumber, $field_email]);
                
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect()->back();
            }else{
                foreach($orgs as $org){
                    $org_id = $org->id;
                }

                $field_supervisor = new Field_supervisor();
                $field_supervisor->fname = $fname;
                $field_supervisor->other = $other;
                $field_supervisor->phonenumber = $phonenumber;
                $field_supervisor->field_email = $field_email;
                $field_supervisor->org_id = $org_id;
                $field_supervisor->save();

                Mail::to($field_email)->send(new Registration());

                $fieldsups = DB::select("select * from field_supervisors where fname='$fname' and org_id=$org_id");
                foreach($fieldsups as $fieldsup){
                    $fieldsup_id = $fieldsup->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $fieldsup_id, $start, $end, $id]);

                $request->session()->flash('Success', 'Details have been saved!');
                return redirect()->back();
            }
        }
        else
        {
            $organisation = new Organisation();
            $organisation->name = $org_name;
            $organisation->address = $address;
            $organisation->additional_address_info = request('additional_information');
            $organisation->region = request('region');
            $organisation->town = request('town');
            $organisation->phonenumber = request('contact');
            $organisation->email = request('email');
            $organisation->save();

            $organs = DB::select("select * from organisations where address='$address' and name='$org_name'");
            foreach($organs as $organ){
                $organ_id = $organ->id;
            }

            $fields = DB::select("select * from field_supervisors where field_email='$field_email' and org_id=$organ_id"); 
            if(!empty($fields))
            {
                foreach($fields as $field){
                    $field_supervisor_id = $field->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$organ_id, $field_supervisor_id, $start, $end, $id]);
                DB::update("update field_supervisors set fname=?, other=?, phonenumber=? where field_email=?", [$fname, $other, $phonenumber, $field_email]);
                
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect()->back();
            }else{
                foreach($orgs as $org){
                    $org_id = $org->id;
                }

                $field_supervisor = new Field_supervisor();
                $field_supervisor->fname = $fname;
                $field_supervisor->other = $other;
                $field_supervisor->phonenumber = $phonenumber;
                $field_supervisor->field_email = $field_email;
                $field_supervisor->org_id = $org_id;
                $field_supervisor->save();

                Mail::to($field_email)->send(new Registration());

                $fieldsups = DB::select("select * from field_supervisors where fname='$fname' and org_id=$org_id");
                foreach($fieldsups as $fieldsup){
                    $fieldsup_id = $fieldsup->id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $fieldsup_id, $start, $end, $id]);

                $request->session()->flash('Success', 'Details have been saved!');
                return redirect()->back();
            }
        }
    }

    public function logbook()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $students = DB::select("select * from students where user_id=$user_id");
        foreach($students as $student)
        {
            $field_supervisor_id = $student->field_supervisor_id;
            $org_id = $student->org_id;
        }

        if($org_id != null && $field_supervisor_id != null)
        {
            $organisations = DB::select("select * from organisations where id=$org_id");
            $field_supervisors = DB::select("select * from field_supervisors where id=$field_supervisor_id");

        }else{
            $organisations = 0;
            $field_supervisors = 0;
        }

        $logbooks = DB::select("select * from daily_journals where user_id=$user_id");
        if(!empty($logbooks))
        {
            if($organisations == 0 && $field_supervisors == 0)
            {
                return view('Student.dailyJournalEdit1', compact('user', 'students', 'logbooks'));
            }else{
                return view('Student.dailyJournalEdit', compact('user', 'students', 'organisations', 'field_supervisors', 'logbooks'));
            }
        }else{
            if($organisations == 0 && $field_supervisors == 0)
            {
                return view('Student.dailyJournal1', compact('user', 'students'));
            }else{
                return view('Student.dailyJournal', compact('user', 'students', 'organisations', 'field_supervisors'));
            }
        }
    }

    public function fillJournal(Request $request, $id)
    {
        $validate = $request->validate([
            'field_supervisor_fname' => 'required|string|max:255',
            'field_supervisor_other' => 'required|string|max:255',
            'academic_supervisor_fname' => 'required|string|max:255',
            'academic_supervisor_other' => 'required|string|max:255',
            'org_name' => 'required|string|max:255',
            'org_address' => 'required|string|max:255',
            'org_number' => 'required|min:9|max:14'
        ]);

        $user = Auth::user();
        $user_id = $user->id;
        $studs = DB::select("select * from students where user_id=$user_id");
        foreach($studs as $stud)
        {
            $std_number = $stud->std_number;
        }
        $org_name = $request->input('org_name');
        $org_address = $request->input('org_address');
        $org_number = $request->input('org_number');
        $field_fname = $request->input('field_supervisor_fname');
        $field_other = $request->input('field_supervisor_other');

        $orgs = DB::select("select * from organisations where name='$org_name' and phonenumber='$org_number'");
        foreach($orgs as $org)
        {
            $org_id = $org->id;
        }

        $fields = DB::select("select * from field_supervisors where fname='$field_fname' and other='$field_other'");
        foreach($fields as $field)
        {
            $field_supervisor_id = $field->id;
        }

        $Device_Browser_detail = $request->server('HTTP_USER_AGENT');
        $User_IP = $request->getClientIp(); 

        $fill = new Daily_journal();
        $fill->user_id = $user_id;
        $fill->std_number = $std_number;
        $fill->org_id = $org_id;
        $fill->field_supervisor_id = $field_supervisor_id;
        $fill->academic_supervisor_fname = $request['academic_supervisor_fname'];
        $fill->academic_supervisor_other = $request['academic_supervisor_other'];
        $fill->User_Ip = $User_IP;
        $fill->Device_Browser_Detail =  $Device_Browser_detail;
        $fill->save();

        $request->session()->flash('Success', 'Details have been saved!');
        return redirect('/Student');   
    }

    public function editJournal(Request $request, $id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $org_name = $request->input('org_name');
        $org_address = $request->input('org_address');
        $org_number = $request->input('org_number');
        $field_fname = $request->input('field_supervisor_fname');
        $field_other = $request->input('field_supervisor_other');
        $academic_supervisor_fname = $request->input('academic_supervisor_fname');
        $academic_supervisor_other = $request->input('academic_supervisor_other');

        $orgs = DB::select("select * from organisations where name='$org_name' and phonenumber='$org_number'");
        foreach($orgs as $org)
        {
            $org_id = $org->id;
        }

        $fields = DB::select("select * from field_supervisors where fname='$field_fname' and other='$field_other'");
        foreach($fields as $field)
        {
            $field_supervisor_id = $field->id;
        }

        DB::update("update daily_journals set org_id=?, field_supervisor_id=?, academic_supervisor_fname=?, academic_supervisor_other=? where user_id=?", [$org_id, $field_supervisor_id, $academic_supervisor_fname, $academic_supervisor_other, $user_id]);
        $request->session()->flash('Success', 'Details have been saved!');
        return redirect()->back();
    }

    public function placementLetter()
    {
        $user = Auth::user();
        return view('Student.placementletter', compact('user'));
    }

    public function delete(Request $request, $name){
       
        DB::table('uploads')->where('name', $name)->delete();
        $path = 'public/upload/$name';
        $path1 = storage_path('/app/public/public/upload/'.$name);
        if(Storage::exists($path1)){
            Storage::delete($name);
        }
         return redirect('/Student')->with('Success', 'File has been deleted!');
     }
    public function view_file(Request $request, $name){   // enhance function to accept other types of files....
    
            $path = storage_path('/app/public/public/upload/'.$name);
            $headers = array([
                'Content-Type' => 'application/vnd.oasis.opendocument.text',
                'Content-Type' => 'application/msword',
                'Content-Type' => 'application/vnd.oasis.openxmlformats-officedocument.wordprocessingml.document',
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Type' => 'application/vnd.ms-powerpoint',
                'Content-Type' => 'application/octet-stream', 
                'Content-Type' => 'text/plain',
                'Content-Disposition' => 'inline; filename = "'.$name.'"'
       ]);
            return response()->download($path, 'Test File', $headers, 'inline');  
              
    }
    
     public function view(request $request,$id, $user_id){
            $user = Auth::user();
        if($user->id == $user_id){  // code or logic to stop url/routes violation by users
            $upload = Upload::find($id);
         return view('Student.view')->with('upload', $upload);
        }else
            return redirect('/Student')->with('Success', 'Impossible, access denied!');
     }

    public function upload(request $request, $id)
    {
        $detail = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($detail, 'Firefox')){
            $browser = 'Mozilla Firefox';
        }elseif(strpos($detail, 'Chrome')){
           $browser = 'Google Chrome';
        }elseif(strpos($detail, 'Opera') || strpos($detail, 'OPR/')){
           $browser = 'OperaMini';
        }elseif(strpos($detail, 'Safari')){
           $browser = 'Safari';
        }elseif(strpos($detail, 'Egde')){
           $browser = 'Microsoft Edge';
        }elseif(strpos($detail, 'MSIE') || strpos($detail, 'Trident/7')){
           $browser = 'Internet Explorer';
        }else 
           $browser = 'Other';

        if(preg_match('/linux/i', $detail)){
           $platform = 'Linux';
        }else if(preg_match('/macintosh|mac os x/i', $detail)){
           $platform = 'Macintosh';
        }else if(preg_match('/windows|win32/i', $detail)){
           $platform = 'Windows';
        }else if(preg_match('/android/i', $detail)){
            $platform = 'Android';
         }else 
            $platform = 'Other';

        $user = Auth::user();
        $user_id = $user->id;
        $studs = DB::select("select * from students where user_id='$user_id'");
        $request->validate([
            'file' => 'required|file|max:3072',  // code to validate size of the file..
        ]);

         if($request->hasFile('file')){

            $filename = $request->file->getClientOriginalName();
            $filesize = $request->file->getSize();
            // $fileUser_IP = $_SERVER['REMOTE_ADDR'];
            $fileUser_IP =  $request->ip();

            $request->file->storeAs('public/upload', $filename);
            $file = new Upload();
            $file->name = $filename;
            $file->size = $filesize;
            $file->user_id = $user_id;
            $file->User_Ip = $fileUser_IP;
            $file->Device_Browser =  $browser;
            $file->Device_platform = $platform;
            $file->save();
           
     
           return redirect('/Student/placementletter')->with('Success', 'File Has been Uploaded');

         }
         return $request->all();
    }

    public function report()
    {
        $user = Auth::user();
        return view('Student.weeklyReport', compact('user'));
    }

    public function reportedit()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $reports = DB::select("select * from reports where user_id=$user_id");
        if(!empty($reports)){
            return view('Student.reportedit', compact('reports', 'user'));
        }else{
            return view('Student.weeklyReport', compact('user'));
        }
    }

    public function reportedit1($id)
    {
        $reports = DB::select("select * from reports where id=$id");
        return view('Student.reportedit1', compact('reports'));
    }

    public function fillReportEdit(Request $request, $id)
    {
        $validate = $request->validate([
            'date' => 'required|date|before_or_equal:now'
        ]);


        $date = $request->input('date');
        $task_completed = $request->input('task_completed');
        $task_in_progress = $request->input('task_in_progress');
        $next_day_tasks = $request->input('next_day_tasks');
        $problems = $request->input('problems');
        $Device_Browser_detail = $request->server('HTTP_USER_AGENT');
        $User_IP = $request->getClientIp(); 

        DB::update("update reports set date=?, task_completed=?, task_in_progress=?, next_day_tasks=?, problems=?, Device_Browser_detail=?, User_Ip=? where id=?", [$date, $task_completed, $task_in_progress, $next_day_tasks, $problems, $Device_Browser_detail, $User_IP, $id]);

        $request->session()->flash('Success', 'Details have been saved!');
        return redirect('/Student/reportedit');
    }

    public function fillReport(Request $request, $id)
    {
        $validate = $request->validate([
            'date' => 'required|date|before_or_equal:now'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $Device_Browser_detail = $request->server('HTTP_USER_AGENT');
        $User_IP = $request->getClientIp(); 

        $report = new Report();
        $report->user_id = $user_id;
        $report->date = $request['date'];
        $report->task_completed = $request['task_completed'];
        $report->task_in_progress = $request['task_in_progress'];
        $report->next_day_tasks = $request['next_day_tasks'];
        $report->problems = $request['problems'];
        $report->User_Ip = $User_IP;
        $report->Device_Browser_Detail = $Device_Browser_detail;

        $report->save();

        $request->session()->flash('Success', 'Details have been saved!');
        return redirect('/Student');   
    }


}
 /*$path = "/public/upload/".$name;
          $headers = array([
            'Content-Type' => 'application/pdf, base64;',
            'Content-Disposition' => 'inline; filename = "'.$name.'"'
          ]);
           $contents = Storage::get($path);
         return Response::make($contents, 200, $headers);
         
          /* if(strpos($filename, 'pdf')){
            $file = storage_path('/app/public/public/upload/'.$name);
            $headers = [
            'Content-Type' => 'application/pdf',
         ];
         return response()->download($file, 'Test File', $headers, 'inline');
       }else

         else if(strpos($filename, 'PNG') || strpos($filename, 'png') || strpos($filename, 'jpg') || strpos($filename, 'jpeg')){
             return redirect('/Student')->with('Success', 'Upload pdf Format Preferably.');
         }else
         */