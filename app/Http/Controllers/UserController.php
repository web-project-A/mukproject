<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use DB;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function editStud()
    {
        $student = Auth::user();
        $student_id = $student->id;
        $studs = DB::select("select * from students where user_id=$student_id");
        return view('users.editStud', compact('student', 'studs'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $userss = DB::select("select * from users where id=$id");
        foreach($userss as $users)
        {
            $user_type = $users->user_type;
        }
        if($user_type == 'Field Supervisor')
        {
            $validate = $request->validate([

                'fname' => 'required|string|max:255',
                'other' => 'required|string|max:255',
                'gender' => 'required',
                'number' => 'required|min:9|max:14',
                'password' => 'required|string|min:8|confirmed',
                'email' => 'required|email|string|max:255'

            ]);

            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->gender = $request['gender'];
            $user->phonenumber = $request['number'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $fname = $request->input('fname');
            $other = $request->input('other');
            $phonenumber = $request->input('number');
            DB::update("update field_supervisors set fname=?, other=?, phonenumber=? where user_id=?", [$fname, $other, $phonenumber, $id]);

            $request->session()->flash('Success', 'Your details have been updated! Please Login Again');
            return redirect()->back();
        }else{
            if($user) {
                $validate = $request->validate([
    
                    'fname' => 'required|string|max:255',
                    'other' => 'required|string|max:255',
                    'gender' => 'required',
                    'number' => 'required|min:9|max:14',
                    'password' => 'required|string|min:8|confirmed',
                    'email' => 'required|email|string|max:255'
    
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
    }

    public function updateStud(Request $request, $id)
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

            $stud_std_number = $request->input('std_number');
            $stud_reg_number = $request->input('reg_number');
            $stud_course = $request->input('course');

            DB::update("update students set std_number=?, reg_number=?, course=? where user_id=?", [$stud_std_number, $stud_reg_number, $stud_course, $id]);

            $user->fname = $request['fname'];
            $user->other = $request['other'];
            $user->gender = $request['gender'];
            $user->phonenumber = $request['number'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->save();

            $request->session()->flash('Success', 'Your details have been updated! Please Login Again');
            return redirect()->back();
    }

    public function back()
    {
        switch(Auth::user()->role){
            case 2:
                return redirect('/Regional');
                break;
            case 4:
                return redirect('/Academic');
                break;
            case 3:
                return redirect('/Department');
                break;
            case 5:
                return redirect('/Field');
                break;
            case 6:
                return redirect('/Student');
                break;
            case 1:
                return redirect('/Overall');
                break;
            default:
                return redirect('/login');
        }
    }
}
