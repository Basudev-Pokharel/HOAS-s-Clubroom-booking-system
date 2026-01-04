<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user['email'] = $request['email'];
        $user['password'] = $request['password'];

        if (Auth::attempt($user)) {
            return redirect()->route('dashboard')->with('status', 'Login SUccessfully');
        } else {
            return redirect()->back()->with('status', 'Credentials doesn"t match');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register(Request $request)
    {
        $details = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'address' => 'required'
        ]);
        if (User::where('email', $details['email'])) {
            return back()->with('account', 'Account already Exists please login...');
        }
        $insert = User::insert($details);
        if ($insert) {
            return redirect('/login')->with('status', 'Register Successfull, Now Login');
        } else {
            return back()->with('status', 'Problem while registering');
        }
    }

    public function changePassword(Request $request)
    {
        // return "You are here";

        $currentpassword = Auth::user()->password;
        $details = $request->validate([
            'old_password' => 'required',
            'newpassword' => 'required|confirmed|different:old_password',
        ]);
        if (Hash::check($details['old_password'], $currentpassword)) {
            $newpassword = bcrypt($details['newpassword']);
            User::where('id', Auth::user()->id)->update(['password' => $newpassword]);
            return redirect('/')->with('status', 'Password Updated successfully');
        } else {
            return back()->with('passwordMismatch', "Old password doesn't match");
        }

        return back()->with('status', 'We are having trouble updating password. Please contact developer');
    }
}
