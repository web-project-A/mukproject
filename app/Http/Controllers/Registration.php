<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\Field_supervisor;
use DB;

class Registration extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'fname' => 'required|string|max:255',
            'other' => 'required|string|max:255',
            'user_type' => 'required|string|max:255',
            'gender' => 'required',
            'number' => 'required|min:9|max:14',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|string|max:255|unique:users'
        ]);

        $fname = $request['fname'];
        $other = $request['other'];
        $phoneCode = $request['phoneCode'];
        $number = $request['number'];
        $phonenumber = $phoneCode . $number;
        if($request['user_type'] == 'Student')
        {
            $validate = $request->validate([
                'std_number' => 'required|string|max:10|min:10|unique:students',
                'reg_number' => 'required|string|max:255|unique:students',
            ]);

            $user = new User();
            $user->fname = $fname;
            $user->other = $other;
            $user->user_type = $request['user_type'];
            $user->gender = $request['gender'];
            $user->phonenumber = $phonenumber;
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $users = DB::table('users')->where('fname', $fname)->where('other', $other)->get();
            foreach($users as $user)
            {
                $user_id = $user->id;
            }

            $stud = new Student();
            $stud->std_number = $request['std_number'];
            $stud->reg_number = $request['reg_number'];
            $stud->course = $request['course'];
            $stud->user_id = $user_id;
            $stud->save();
            return redirect('/')->with('Success', 'You have been Registered!');
        } 
        elseif($request['user_type'] == 'Field Supervisor')
        {
            $user = new User();
            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->user_type = $request['user_type'];
            $user->gender = $request['gender'];
            $user->phonenumber = $phonenumber;
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $users = DB::table('users')->where('fname', $fname)->where('other', $other)->get();
            foreach($users as $user)
            {
                $user_id = $user->id;
            }

            $fields = DB::select("select * from field_supervisors where fname='$fname' and other='$other'");
            if(!empty($fields)){
                foreach($fields as $field){
                    $field_id = $field->id;
                }
                DB::update("update field_supervisors set phonenumber=?, user_id=? where id=?", [$phonenumber, $user_id, $field_id]);
                
                return redirect('/')->with('Success', 'You have been Registered!');
            }else{
                $field_supervisor = new Field_supervisor;
                $field_supervisor->fname = $fname;
                $field_supervisor->other = $other;
                $field_supervisor->phonenumber = $phonenumber;
                $field_supervisor->user_id = $user_id;
                $field_supervisor->save();
    
                return redirect('/')->with('Success', 'You have been Registered!');
            }
        }
        else
        {
            $user = new User();
            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->user_type = $request['user_type'];
            $user->gender = $request['gender'];
            $user->phonenumber = $phonenumber;
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();
            return redirect('/')->with('Success', 'You have been Registered!');
        }
    }
}

/*'fname' => $data['fname'],
'other_name' => $data['other'],
'user_type' => $data['user_type'],
'std_number' => $data['std_number'],
'reg_number' => $data['reg_number'],
'gender' => $data['gender'],
'number' => $data['number'],
'email' => $data['email'],
'password' => Hash::make($data['password']),

            'fname' => ['required', 'string', 'max:255'],
            'other' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'std_number' => ['required', 'string', 'max:255'],
            'reg_number' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:10', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
*/
