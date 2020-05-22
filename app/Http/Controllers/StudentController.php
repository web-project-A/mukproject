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
   
    public function index(Request $request)
    {  
        /*$ip_address = file_get_contents('https://api.ipify.org?format=json'); // use if connected 
        $ip_address = json_decode($ip_address);                             //to network to get real IP
        foreach($ip_address as $key => $value){
           $realip = $value;
        } */
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

    public function match($field_email)
    {
        $matches = DB::select("select * from users where email='$field_email'");
        foreach($matches as $match){
            $user_id = $match->id;
            $fname = $match->fname;
            $other = $match->other;
            $number = $match->phonenumber;
        }

        $fields = DB::select("select * from field_supervisors where user_id=$user_id");
        foreach($fields as $field){
            $org_id = $field->org_id;
        }

        if($org_id != null){
            $organisations = DB::select("select * from organisations where id=$org_id");
            foreach($organisations as $org){
                $name = $org->name;
                $address = $org->address;
                $additional = $org->additional_address_info;
                $region = '<option value="'.$org->region.'">'.$org->region.'</option>';
                $town = '<option value="'.$org->town.'">'.$org->town.'</option>';
                $contact = $org->phonenumber;
                $org_email = $org->email;
            }
            return Response::json(['success'=>true, 'fname'=>$fname, 'other'=>$other, 'number'=>$number, 'name'=>$name, 'address'=>$address, 'additional'=>$additional, 'region'=>$region, 'town'=>$town, 'contact'=>$contact, 'org_email'=>$org_email]);
        }else{
            return Response::json(['success'=>true, 'fname'=>$fname, 'other'=>$other, 'number'=>$number]);
        }
    }

    public function placement(Request $request, $id)
    {
        $validate = $request->validate([
            'field_supervisor_fname' => 'required|string|max:255',
            'field_supervisor_other' => 'required|string|max:255',
            'organisation' => 'required|string|max:255',
            'contact' => 'required|min:9|max:14',
            'phonenumber' => 'required|min:9|max:14',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'email' => 'required|email|string|max:255|unique:users'
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
            $user->role = 6;
            $user->user_approved = 1;
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
            $user->role = 6;
            $user->user_approved = 1;
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

    public function viewplacement()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $uploads = DB::select("select * from uploads where user_id=$user_id");
        if(empty($uploads))
        {
            $upload_check = "No files uploaded yet!";
        }else
            $upload_check = " ";
        $user = Auth::user();
        $file = DB::table('uploads')->get();
        $upload = DB::table('uploads')->get();
        $display = DB::table('uploads')->get();
        return view('Student.viewplacement', compact('user', 'file', 'upload', 'display', 'upload_check'));
    }

    public function placementLetter()
    {
        $user = Auth::user();
        return view('Student.placementletter', compact('user'));
    }

    public function delete(Request $request, $name){
       
        DB::table('uploads')->where('name', $name)->delete();
       // $path = storage_path('app/public/upload/'.$name);
        $path = storage_path('app/public/public/upload/'.$name); // debate about this, if we should leave the files or not
        if(File::exists($path)){
            //File::delete($path);
        }
         return redirect('/Student/reupload')->with('Success', 'File has been deleted!');
     }

    public function view_file(Request $request, $name){   
            
           // $path = storage_path('app/public/upload/'.$name);
            $path = storage_path('app/public/public/upload/'.$name);
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
            return redirect('/Student')->with('Success', 'Access denied!');
     }
     public function reupload()
    {
        $user = Auth::user();
        return view('Student.reupload', compact('user'));
    }

    public function view_guidelines()
    {
        $name = 'field_attachment_guidelines.pdf'; 
        $path = storage_path('app/'.$name);
            $headers = array([
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename = "'.$name.'"'
       ]);
            return response()->download($path, 'Test File', $headers, 'inline');  
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

        $request->validate([
            'file' => 'required|file|max:3072',  
        ]);

         if($request->hasFile('file')){
            $filename = $request->file->getClientOriginalName();
            $filesize = $request->file->getSize();
           // $fileUser_IP =  $request->ip();                                         // use if on localhost
          $ip_address = file_get_contents('https://api.ipify.org?format=json'); // use if connected 
              $ip_address = json_decode($ip_address);                             //to network to get real IP
              foreach($ip_address as $key => $value){
                 $realip = $value;
             } 
            $request->file->storeAs('public/upload', $filename);
            $file = new Upload();
            $file->name = $filename;
            $file->size = $filesize;
            $file->user_id = $user_id;
            $file->User_Ip = $realip;    // use if online
            //$file->User_Ip = $fileUser_IP;    // use if on localhost
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
        $User_IP = $request->ip();                                          // use if on localhost
        /*$ip_address = file_get_contents('https://api.ipify.org?format=json'); // use if connected 
          $ip_address = json_decode($ip_address);                             //to network to get real IP
          foreach($ip_address as $key => $value){
             $realip = $value;
         } */
     // $report->User_Ip = $realip;            // use if online

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
        $fileUser_IP =  $request->ip();                                         // use if on localhost
        /*$ip_address = file_get_contents('https://api.ipify.org?format=json'); // use if connected 
          $ip_address = json_decode($ip_address);                             //to network to get real IP
          foreach($ip_address as $key => $value){
             $realip = $value;
         } */

        $journal = new Journal();
        $journal->user_id = $user_id;
        $journal->field_supervisor_id = $field_id;
        $journal->date = $request['date'];
        $journal->task_completed = $request['task_completed'];
        $journal->task_in_progress = $request['task_in_progress'];
        $journal->next_day_tasks = $request['next_day_tasks'];
        $journal->problems = $request['problems'];
        $journal->User_Ip = $fileUser_IP;     // use if on localhost
     // $journal->User_Ip = $realip;    // use if online
        $journal->Device_Browser_Detail = $Device_Browser_detail;
        $journal->save();


        $request->session()->flash('Success', 'Details have been saved!');
        return redirect('/Student');   
    }


}
 /*

 $arr_ip = json_encode(geoIp()->getLocation($realip)->toArray());  //getting location from IP address...
   $arr_ip = json_decode($arr_ip);
   foreach($arr_ip as $key => $value){
    if($key == 'ip') {
        $ipv = $value;
        echo "Ip is: ", $ipv;
   }

    $urlTemp = 'https://api.ip2location.com/v2/?' . 'ip=%s&key=demo' . '&package=WS24&format=json';
        $ip = $realip;
        $url = sprintf($urlTemp, $ip);
        $Json = file_get_contents($url);
        $geoLocation = json_decode($Json, true );
       
         foreach($geoLocation as $key => $value){
               if($key == 'country_code'){
                $country_code = $value;
              }if($key == 'country_name'){
                  $country_name = $value;
              }if($key == 'region_name'){
                  $region_name = $value;
              }if($key == 'city_name'){
                  $city_name = $value;
              }if($key == 'latitude'){
                  $latitude = $value;
              }if($key == 'longitude'){
                  $longitude = $value;
              }if($key == 'time_zone'){
                  $time_zone = $value;
              }if($key == 'net_speed'){
                $net_speed = $value;
            }   if($key == 'idd_code'){
                  $idd_code = $value;
              }if($key == 'area_code'){
                  $area_code = $value;
              }    
         }
         $location = new Location();
         $location->ip_addr =  $ip;
         $location->user_id = $user_id;
         $location->country_code  = $country_code;
         $location->country_name = $country_name;
         $location->region_name = $region_name;
         $location->city_name = $city_name;
         $location->net_speed = $net_speed;
         $location->area_code  = $area_code ;
         $location->latitude = $latitude;
         $location->longitude = $longitude;
         $location->time_zone = $time_zone;

         $location->save();
         */