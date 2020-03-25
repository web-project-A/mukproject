<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function editStud()
    {
        $student = Auth::user();
        return view('users.editStud', compact('student'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user) {
            $validate = $request->validate([

                'fname' => 'required|string|max:255',
                'other' => 'required|string|max:255',
                'gender' => 'required',
                'number' => 'required|min:9|max:14',
                'password' => 'required|string|min:8|confirmed',
                'email' => 'required|email|string|max:255|unique:users'

            ]);

            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->gender = $request['gender'];
            $user->number = $request['number'];
            $user->phoneCode = $request['phoneCode'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $request->session()->flash('Success', 'Your details have been updated! Please Login Again');
            return redirect()->back();
        }else {
            return redirect()->back();
        }
    }

    public function updateStud(Request $request, $std_number)
    {
        $user = User::find(Auth::user()->id);

            $validate = $request->validate([
                'fname' => 'required|string|max:255',
                'other' => 'required|string|max:255',
                'std_number' => 'required|string|max:10|min:10',
                'reg_number' => 'required|string|max:255',
                'gender' => 'required',
                'number' => 'required|min:9|max:14',
                'password' => 'required|string|min:8|confirmed',
                'email' => 'required|email|string|max:255'
            ]);

            $stud_fname = $request->input('fname');
            $stud_other_name = $request->input('other');
            $stud_std_number = $request->input('std_number');
            $stud_reg_number = $request->input('reg_number');
            $stud_course = $request->input('course');
            $stud_gender = $request->input('gender');
            $stud_number = $request->input('number');
            $stud_email = $request->input('email');

            DB::update("update students set fname=?, other_name=?, reg_number=?, course=?, gender=?, number=?, email=? where std_number=?", [$stud_fname, $stud_other_name, $stud_reg_number, $stud_course, $stud_gender, $stud_number, $stud_email, $std_number]);

            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->std_number = $request['std_number'];
            $user->reg_number = $request['reg_number'];
            $user->course = $request['course'];
            $user->gender = $request['gender'];
            $user->number = $request['number'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $request->session()->flash('Success', 'Your details have been updated! Please Login Again');
            return redirect()->back();
    }
}
