<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

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

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user) {
            $validate = $request->validate([
                'name' => 'required',
                'phoneCode' => 'required',
                'gender' => 'required',
                'number' => 'required|min:9|max:14',
                'email' => 'required|email'
            ]);

            $user->name = $request['name'];
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
