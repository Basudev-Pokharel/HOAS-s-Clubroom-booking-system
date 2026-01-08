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
            return redirect()->route('dashboard')->with('status', 'Login Successfully🎉👋');
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
            'address' => 'required',
            'contact_no' => 'nullable'
        ]);
        if (User::where('email', $details['email'])->exists()) {
            return back()->with('account', 'Account already Exists please login...');
        }
        $insert = User::insert([
            'name' => $details['name'],
            'email' => $details['email'],
            'password' => Hash::make($details['password']),
            'address' => $details['address'],
            'contact_no' => $details['contact_no'],
        ]);
        if ($insert) {
            return redirect('/login')->with('status', 'Register Successfull, Now Login');
        } else {
            return back()->with('status', 'Problem while registering');
        }
    }

    public function changePassword(Request $request)
    {
        $currentpassword = Auth::user()->password;
        $details = $request->validate([
            'old_password' => 'required',
            'newpassword' => 'required|confirmed|different:old_password',
        ]);
        if (Hash::check($details['old_password'], $currentpassword)) {
            $newpassword = bcrypt($details['newpassword']);
            User::where('id', Auth::user()->id)->update(['password' => $newpassword]);
            return back()->with('status', 'Password Updated successfully');
        } else {
            return back()->with('status', "Old password doesn't match");
        }

        return back()->with('status', 'We are having trouble updating password. Please contact developer');
    }
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user['email'] = $request['email'];
        $user['password'] = $request['password'];

        if (Auth::attempt($user)) {
            if (Auth::user()->isAdmin) {
                return redirect()
                    ->route('admin.user.dashboard')
                    ->with('status', 'Welcome Admin');
            }
        } else {
            return redirect()->back()->with('status', 'Credentials doesn"t match');
        }
    }
    public function promoteToAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
        $promote = User::find($request->user_id);
        if ($promote) {
            $promote->isAdmin = 1;
            $isUpdate = $promote->save();
        } else {
            return back()->with('status', 'Admin Not found');
        }
        if ($isUpdate) {
            return back()->with('status', 'Successfully Added Admin');
        } else {
            return back()->with('status', 'There was a problem adding, Contact Developers');
        }
    }
    public function removeToNonAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
        $promote = User::find($request->user_id);
        if ($promote) {
            $promote->isAdmin = 0;
            $isUpdate = $promote->save();
        } else {
            return back()->with('status', 'Admin Not found');
        }
        if ($isUpdate) {
            return back()->with('status', 'Successfully Removed Admin Title');
        } else {
            return back()->with('status', 'There was a problem removing, Contact Developers');
        }
    }
    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
        $user = User::find($request->user_id);
        if ($user) {
            $isDelete = $user->delete();
        } else {
            return back()->with('status', 'Admin Not found');
        }
        if ($isDelete) {
            return back()->with('status', 'Successfully Deleted Member');
        } else {
            return back()->with('status', 'There was a problem removing, Contact Developers');
        }
    }
}
