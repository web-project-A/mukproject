<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\Registration;
use Illuminate\Support\Facades\Mail;


use App\Student;
use App\Organisation;
use App\Region;
use App\Field_supervisor;
use App\Upload;
use App\Journal;
use App\User;

use DB;
use File;
use Storage;
use Response;
use GeoIP;



class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        //$arr_ip = geoIp()->getLocation($_SERVER['REMOTE_ADDR']); //getting location from IP address...
        //$arr_ip = geoIp()->getLocation('102.80.17.127');
        //dd($arr_ip);
        $user = Auth::user();
        $user_id = $user->id;

        $uploads = DB::select("select count(user_id) as number from uploads where user_id=$user_id");
        foreach($uploads as $upload){
            $upload_number = $upload->number;
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

        $journals = DB::select("select count(user_id) as number from journals where user_id=$user_id");
        foreach($journals as $journal){
            $journal_number = $journal->number;
        }
        
        $file = DB::table('uploads')->where('user_id', '=', $user_id)->get();
        $upload = DB::table('uploads')->where('user_id', '=', $user_id)->get();
        $display = DB::table('uploads')->where('user_id', '=', $user_id)->get();

        return view('Student.home', compact('upload_number', 'user', 'placement_check', 'journal_number','file','upload','display'));
    }
    
    public function viewplacement()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $file = DB::table('uploads')->get();
        $upload = DB::table('uploads')->get();
        $display = DB::table('uploads')->get();
        $check = DB::select("select * from uploads where user_id=$user_id");
        if(!empty($check)){
            return view('Student.viewplacement', compact('user', 'file', 'upload', 'display'));
        }else{
            return view('Student.placementletter', compact('user'));
        }
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
            $fields = DB::select("select * from users where id=$field_supervisor_id");
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
        $users = DB::select("select * from users where email='$field_email'");
        if(!empty($users)){
            foreach($users as $user){
                $user_id = $user->id;
            }
            if(!empty($orgs)){
                foreach($orgs as $org){
                    $org_id = $org->id;
                }
    
                $fields = DB::select("select * from field_supervisors where user_id=$user_id and org_id=$org_id");
                foreach($fields as $field){
                    $field_supervisor_id = $field->user_id;
                }
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $field_supervisor_id, $start, $end, $id]);
                    
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }else{
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

                DB::update("update field_supervisors set org_id=? where user_id=?", [$organ_id, $user_id]);
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$organ_id, $user_id, $start, $end, $id]);
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }
        }else{
            $user = new User();
            $user->fname = $fname;
            $user->other = $other;
            $user->phonenumber = $phonenumber;
            $user->email = $field_email;
            $user->role = 5;
            $user->save();

            $users = DB::select("select * from users where email='$field_email'");
            foreach($users as $user){
                $user_id = $user->id;
            }

            if(!empty($orgs)){
                foreach($orgs as $org){
                    $org_id = $org->id;
                }
    
                $field_supervisor = new Field_supervisor();
                $field_supervisor->user_id = $user_id;
                $field_supervisor->org_id = $org_id;
                $field_supervisor->save();
    
                Mail::to($field_email)->send(new Registration($users));
    
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $user_id, $start, $end, $id]);
                    
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }else{
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

                $field_supervisor = new Field_supervisor();
                $field_supervisor->user_id = $user_id;
                $field_supervisor->org_id = $organ_id;
                $field_supervisor->save();
    
                Mail::to($field_email)->send(new Registration($users));
                
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$organ_id, $user_id, $start, $end, $id]);
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
            'phonenumber' => 'required|min:9|max:14',
            'contact' => 'required|min:9|max:10',
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

        $orgs = DB::select("select * from organisations where address='$address' and name='$org_name'");

        $users = DB::select("select * from users where email='$field_email'");
        if(!empty($users)){
            foreach($users as $user){
                $user_id = $user->id;
            }
            if(!empty($orgs)){
                foreach($orgs as $org){
                    $org_id = $org->id;
                }
    
                DB::update("update organisations set additional_address_info=?, region=?, town=?, phonenumber=?, email=? where id=?", [$additional, $region, $town, $number, $email, $org_id]);
                $fields = DB::select("select * from field_supervisors where user_id=$user_id and org_id=$org_id");
                foreach($fields as $field){
                    $field_supervisor_id = $field->user_id;
                }
                DB::update("update users set fname=?, other=?, phonenumber=? where id=?", [$fname, $other, $phonenumber, $field_supervisor_id]);
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $field_supervisor_id, $start, $end, $id]);
                    
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }else{
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

                DB::update("update field_supervisors set org_id=? where user_id=?", [$organ_id, $user_id]);
                DB::update("update users set fname=?, other=?, phonenumber=? where id=?", [$fname, $other, $phonenumber, $user_id]);
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$organ_id, $user_id, $start, $end, $id]);
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }
        }else{
            $user = new User();
            $user->fname = $fname;
            $user->other = $other;
            $user->phonenumber = $phonenumber;
            $user->email = $field_email;
            $user->role = 5;
            $user->save();

            $users = DB::select("select * from users where email='$field_email'");
            foreach($users as $user){
                $user_id = $user->id;
            }

            if(!empty($orgs)){
                foreach($orgs as $org){
                    $org_id = $org->id;
                }
    
                $field_supervisor = new Field_supervisor();
                $field_supervisor->user_id = $user_id;
                $field_supervisor->org_id = $org_id;
                $field_supervisor->save();
    
                Mail::to($field_email)->send(new Registration($users));

                DB::update("update organisations set additional_address_info=?, region=?, town=?, phonenumber=?, email=? where id=?", [$additional, $region, $town, $number, $email, $org_id]);
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$org_id, $user_id, $start, $end, $id]);
                    
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }else{
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

                $field_supervisor = new Field_supervisor();
                $field_supervisor->user_id = $user_id;
                $field_supervisor->org_id = $organ_id;
                $field_supervisor->save();
    
                Mail::to($field_email)->send(new Registration($users));
                
                DB::update("update students set org_id=?, field_supervisor_id=?, start_date=?, end_date=? where user_id=?", [$organ_id, $user_id, $start, $end, $id]);
                $request->session()->flash('Success', 'Details have been saved!');
                return redirect('/Student');
            }
        }
    }

    public function placementLetter()
    {
        $user = Auth::user();
        return view('Student.placementletter', compact('user'));
    }

    public function delete(Request $request, $name){
       
        DB::table('uploads')->where('name', $name)->delete();
        $path = storage_path('app/public/upload/'.$name);
       // $path = storage_path('app/public/public/upload/'.$name); // debate about this, if we should leave the files or not
        if(File::exists($path)){
            //File::delete($path);
        }
         return redirect('/Student')->with('Success', 'File has been deleted!');
     }

    public function view_file(Request $request, $name){   // enhance function to accept other types of files....
            
            $path = storage_path('app/public/upload/'.$name);
            //$path = storage_path('app/public/public/upload/'.$name);
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
     
           return redirect('/Student')->with('Success', 'File Has been Uploaded');


         }
         return $request->all();
    }

    public function dailyJournal()
    {
        $user = Auth::user();
        return view('Student.dailyJournal', compact('user'));
    }

    public function journaledit()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $journals = DB::select("select * from journals where user_id=$user_id");
        if(!empty($journals)){
            return view('Student.journaledit', compact('journals', 'user'));
        }else{
            return view('Student.dailyJournal', compact('user'));
        }
    }

    public function journaledit1($id)
    {
        $journals = DB::select("select * from journals where id=$id");
        return view('Student.journaledit1', compact('journals'));
    }

    public function filljournalEdit(Request $request, $id)
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

        DB::update("update journals set date=?, task_completed=?, task_in_progress=?, next_day_tasks=?, problems=?, Device_Browser_detail=?, User_Ip=? where id=?", [$date, $task_completed, $task_in_progress, $next_day_tasks, $problems, $Device_Browser_detail, $User_IP, $id]);

        $request->session()->flash('Success', 'Details have been saved!');
        return redirect('/Student/journaledit');
    }

    public function filljournal(Request $request, $id)
    {
        $validate = $request->validate([
            'date' => 'required|date|before_or_equal:now'
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $students = DB::select("select * from students where user_id=$user_id");
        foreach($students as $student){
            $field_id = $student->field_supervisor_id;
        }

        $Device_Browser_detail = $request->server('HTTP_USER_AGENT');
        $User_IP = $request->getClientIp(); 

        $journal = new Journal();
        $journal->user_id = $user_id;
        $journal->field_supervisor_id = $field_id;
        $journal->date = $request['date'];
        $journal->task_completed = $request['task_completed'];
        $journal->task_in_progress = $request['task_in_progress'];
        $journal->next_day_tasks = $request['next_day_tasks'];
        $journal->problems = $request['problems'];
        $journal->User_Ip = $User_IP;
        $journal->Device_Browser_Detail = $Device_Browser_detail;
        $journal->save();

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

          $location = GeoIP::getLocation();
             //$country = $location['country'];
             echo  $location;
         
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