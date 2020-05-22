<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\Field_supervisor;
use DB;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Registration extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

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

        if($request['gender'] == 'Male'){
            $gender = 'M';
        }else{
            $gender = 'F';
        }

        if($request['user_type'] == 'Student')
        {
            $validate = $request->validate([
                'std_number' => 'required|string|max:10|min:10|unique:students',
                'reg_number' => 'required|string|max:255|unique:students',
            ]);
            $role = 7;

            $user = new User();
            $user->fname = $fname;
            $user->other = $other;
            $user->role = $role;
            $user->gender = $gender;
            $user->phonenumber = $phonenumber;
            $user->email = $request['email'];
            $user->user_approved = 1;
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
        }else{
            $user = new User();
            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->gender = $gender;
            $user->phonenumber = $phonenumber;
            $user->email = $request['email'];
            $user->user_approved = 1;
            $user->password = bcrypt($request['password']);
            $user->save();
            return redirect('/')->with('Success', 'You have been Registered!');
        }
    }

    public function fieldregister(Request $request, $id){
        $validate = $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $password = bcrypt($request['password']);

        if($request['gender'] == 'Male'){
            $gender = 'M';
        }else{
            $gender = 'F';
        }
        
        DB::update("update users set gender=?, password=? where id=?", [$gender, $password, $id]);
        return redirect('/')->with('Success', 'You have been Registered!');
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
