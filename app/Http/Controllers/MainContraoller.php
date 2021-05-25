<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MainContraoller extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        $admins = Role::all();
        return view('auth.register', compact('admins'));
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
            'conpass' => 'required|same:password',
        ], [
            'name.required' => '**Name required for Registration',
            'email.required' => '**Email required for Registration',
            'password.required' => '**Password required for Registration',
            'conpass.required' => '**Confirm Password required',
            'conpass.same' => '**Both Password must be same.',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->role = $request->role;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $data = $admin->save();

        if ($data) {
            return redirect('/adminlogin')->with('success', 'New user added successfully!');
        } else {
            return back()->with('fail', 'Something went wrong, try again later!');
        }
    }

    public function checkUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => '**Email required for login',
            'password.required' => '**Password required for login',
        ]);

        $userInfo = Admin::where('email', '=', $request->email)->first();
        if (!$userInfo) {
            return back()->with('fail', '**Email not found in database!');
        } else {
            if (Hash::check($request->password, $userInfo->password)) {
                $request->session()->put('LoggedUser', $userInfo->id);
                $request->session()->put('Logged_Email', $userInfo->name);
                return redirect('/admin');
            } else {
                return back()->with('fail', '**Password Incorrect!');
            }
        }
    }
}