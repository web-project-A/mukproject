<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
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
        $this->middleware('auth');
    }

    public function index()
    {
      $user = Auth::user();
      $user_id = $user->id;

      $field_ids = DB::select("select * from field_supervisors where user_id=$user_id");
      foreach($field_ids as $field_id){
        $field_sup_id = $field_id->id;
      }

      $students = DB::table('students')
                      ->where('field_supervisor_id', '=', $field_sup_id)
                      ->leftJoin('users', 'students.user_id', '=', 'users.id')
                      ->get();

      return view('Field.home', compact('user', 'students'));
    }

    public function assess()
    {
      $user = Auth::user();
      $user_id = $user->id;

      $field_ids = DB::select("select * from field_supervisors where user_id=$user_id");
      foreach($field_ids as $field_id){
        $field_sup_id = $field_id->id;
      }

      $students = DB::table('students')
                      ->where('field_supervisor_id', '=', $field_sup_id)
                      ->leftJoin('users', 'students.user_id', '=', 'users.id')
                      ->get();

      return view('Field.viewreports', compact('user', 'students'));
    }

    public function viewreports1($id)
    {
      $users = DB::select("select * from users where id=$id");
      foreach($users as $user){
        $fname = $user->fname;
        $other = $user->other;
      }
      $reports = DB::select("select * from reports where user_id=$id");
      return view('Field.viewreports1', compact('reports', 'fname', 'other'));
    }

    public function viewreports2($id)
    {
      $reports = DB::select("select * from reports where id=$id");
      foreach($reports as $report){
        $user_id = $report->user_id;
      }
      $users = DB::select("select * from users where id=$user_id");
      foreach($users as $user){
        $fname = $user->fname;
        $other = $user->other;
      }
      return view('Field.viewreports2', compact('reports', 'fname', 'other'));
    }

    public function fieldFillReport(Request $request, $id)
    {
      $field_supervisor_comments = $request->input('field_comment');
      $Device_Browser_detail = $request->server('HTTP_USER_AGENT');
      $User_IP = $request->getClientIp(); 

      DB::update("update reports set field_supervisor_comments=?, Device_Browser_detail=?, User_Ip=? where id=?", [$field_supervisor_comments, $Device_Browser_detail, $User_IP, $id]);

      $request->session()->flash('Success', 'Details have been saved!');
      return redirect()->back();
    }
}

