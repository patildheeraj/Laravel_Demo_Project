<?php

namespace App\Http\Controllers;

use App\Models\NewUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = Role::join('new_users', 'new_users.role', '=', 'roles.role_id')->get();
        return view('users.user-list', compact('users'));
    }

    public function addUser()
    {
        $roles = Role::all();
        return view('users.add-user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email|unique:new_users,email',
            'password' => 'required|alpha_num',
            'conpass' => 'required|same:password',
            'status' => 'required',
            'role' => 'required',
        ], [
            'firstname.required' => '**First name is required',
            'firstname.alpha' => '**The first name must only contain letters',
            'lastname.required' => '**Last name is required',
            'lastname.alpha' => '**The last name must only contain letters',
            'email.required' => '**Email is required',
            'email.unique' => '**Email already exist',
            'password.required' => '**Password is required',
            'conpass.required' => '**Confirm Password is required',
            'conpass.same' => '**Both password must be same',
            'status.required' => '**Select any one status',
            'role.required' => '**Role is Required'
        ]);

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $password = $request->password;
        $status = $request->status;
        $role = $request->role;

        $newUser = new NewUser();
        $newUser->firstname = $firstname;
        $newUser->lastname = $lastname;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->status = $status;
        $newUser->role = $role;
        $newUser->save();
        return back()->with('success', 'New user added successfully!!');
    }

    public function editUser($id)
    {
        $users = NewUser::find($id);
        $roles = Role::all();
        return view('users.edit-user', compact('users', 'roles'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|alpha_num',
            'conpass' => 'required|same:password',
            'status' => 'required',
            'role' => 'required',
        ], [
            'firstname.required' => '**First name is required',
            'firstname.alpha' => '**The first name must only contain letters',
            'lastname.required' => '**Last name is required',
            'lastname.alpha' => '**The last name must only contain letters',
            'email.required' => '**Email is required',
            'password.required' => '**Password is required',
            'conpass.required' => '**Confirm Password is required',
            'conpass.same' => '**Both password must be same',
            'status.required' => '**Select any one status',
            'role.required' => '**Role is Required'
        ]);

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $password = $request->password;
        $status = $request->status;
        $role = $request->role;

        $newUser = NewUser::find($request->uid);
        $newUser->firstname = $firstname;
        $newUser->lastname = $lastname;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->status = $status;
        $newUser->role = $role;
        $newUser->save();
        return redirect()->route('user.fetch');
        #return back()->with('success', 'user updated successfully!!');
    }

    public function deleteUser($id)
    {
        $user = NewUser::find($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully!!');
    }
}