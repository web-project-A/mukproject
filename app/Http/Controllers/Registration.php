<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;

class Registration extends Controller
{
    public function register(Request $request) 
    {
        $validate = $request->validate([
            'fname' => 'required|string|max:255',
            'other' => 'required|string|max:255',
            'user_type' => 'required|string|max:255',
            'gender' => 'required',
            'number' => 'required|min:10|max:10',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|string|max:255|unique:users'
        ]);

        if($request['user_type'] == 'Student')
        {
            $validate = $request->validate([
                'std_number' => 'required|string|max:10|min:10',
                'reg_number' => 'required|string|max:255',
            ]);
            $user = new User();
            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->user_type = $request['user_type'];
            $user->std_number = $request['std_number'];
            $user->reg_number = $request['reg_number'];
            $user->gender = $request['gender'];
            $user->number = $request['number'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $stud = new Student();
            $stud->std_number = $request['std_number'];
            $stud->reg_number = $request['reg_number'];
            $stud->fname = $request['fname'];
            $stud->other_name = $request['other'];
            $stud->gender = $request['gender'];
            $stud->number = $request['number'];
            $stud->email = $request['email'];
            $stud->save();
            return redirect('/')->with('Success', 'You have been Registered!');
        }else{
            $user = new User();
            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->user_type = $request['user_type'];
            $user->std_number = $request['std_number'];
            $user->reg_number = $request['reg_number'];
            $user->gender = $request['gender'];
            $user->number = $request['number'];
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
