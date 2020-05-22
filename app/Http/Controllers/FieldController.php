<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Mail\sendMail;
use Illuminate\Support\Facades\Mail;

use App\Student;
use App\Organisation;
use App\Region;
use App\Daily_journal;
use App\Field_supervisor;
use App\Upload;
use App\Report;

use DB;

class FieldController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        //$this->middleware('auth');
    }

    public function index()
    {
      $user = Auth::user();
      $user_id = $user->id;

      $students = DB::table('students')
                      ->where('field_supervisor_id', '=', $user_id)
                      ->leftJoin('users', 'students.user_id', '=', 'users.id')
                      ->get();

      $journals = DB::select("select * from journals where field_supervisor_id=$user_id and score IS NULL");

      return view('Field.home', compact('user', 'students', 'journals'));
    }

    public function viewStudentDetails($id)
    {
      $students = DB::table('students')
                      ->where('user_id', '=', $id)
                      ->leftJoin('users', 'students.user_id', '=', 'users.id')
                      ->get();

      return view('Field.viewStudentDetails', compact('students'));
    }

    public function assess()
    {
      $user = Auth::user();
      $user_id = $user->id;

      $students = DB::table('students')
                      ->where('field_supervisor_id', '=', $user_id)
                      ->leftJoin('users', 'students.user_id', '=', 'users.id')
                      ->get();

      return view('Field.viewjournals', compact('user', 'students'));
    }

    public function viewjournals1(Request $request, $id)
    {
      $users = DB::select("select * from users where id=$id");
      foreach($users as $user){
        $fname = $user->fname;
        $other = $user->other;
      }

      $journals = DB::select("select * from journals where user_id=$id");
      if(!empty($journals)){
        return view('Field.viewjournals1', compact('journals', 'fname', 'other'));
      }else{
        $request->session()->flash('Success', 'No Exisiting Daily Journals');
        return redirect()->back();
      }
    }

    public function viewjournals2($id)
    {
      $journals = DB::select("select * from journals where id=$id");
      foreach($journals as $journal){
        $user_id = $journal->user_id;
      }
      $users = DB::select("select * from users where id=$user_id");
      foreach($users as $user){
        $fname = $user->fname;
        $other = $user->other;
      }
      return view('Field.viewjournals2', compact('journals', 'fname', 'other'));
    }

    public function fieldFillJournal(Request $request, $id)
    {
      $field_supervisor_comments = $request->input('field_comment');
      $score = $request->input('score');
      $Device_Browser_detail = $request->server('HTTP_USER_AGENT');
      $User_IP = $request->ip();                                          // use if on localhost
      /*$ip_address = file_get_contents('https://api.ipify.org?format=json'); // use if connected 
        $ip_address = json_decode($ip_address);                             //to network to get real IP
        foreach($ip_address as $key => $value){
           $realip = $value;
       } */
   // $User_Ip = $realip;    // use if online

      DB::update("update journals set field_supervisor_comments=?, score=?, Device_Browser_detail=?, User_Ip=? where id=?", [$field_supervisor_comments, $score, $Device_Browser_detail, $User_IP, $id]);

      $request->session()->flash('Success', 'Details have been saved!');
      return redirect()->back();
    }

    public function sendEmail(Request $request, $email)
    {
      $user = Auth::user();
      $user_id = $user->id;
      $messages = $request->input('sendEmail');
      Mail::to($email)->send(new sendMail($messages));

      $request->session()->flash('Success', 'Email has been sent!');
      return redirect('/Field');
    }
    
}

