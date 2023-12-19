<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view()
    {

        $staff = User::where('role', '=', 'staff')->orderBy('deleted_at', 'asc')->orderBy('name', 'asc')->get();
        $managers = User::where('role', '=', 'manager')->get();

        return view("users.view", [
            'staff' => $staff,
            'managers' => $managers
        ]);
    }

    public function view_user($id)
    {

        $user = User::find($id);

        $department = Department::find($user->department_id);

        return view("users.view-user", [
            'user' => $user,
            'department' => $department
        ]);
    }

    public function suspend($id)
    {

        $user = User::find($id);

        $user->deleted_at = now();

        $user->save();

        session()->flash('message', 'User suspended.');

        return redirect('/users');
    }

    public function reactivate($id)
    {

        $user = User::find($id);

        $user->deleted_at = null;

        $user->save();

        session()->flash('message', 'User reactivated.');

        return redirect('/users');
    }



    public function add_manager(Request $request)
    {

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|unique:users|max:255',
                'name' => 'required',
            ]);

            // add the new user
            User::create([
                'name' => $request->input("name"),
                'email' => $request->input("email"),
                'role' => 'manager',
                'password' => Hash::make($request->input("Welcome@1234")),
            ]);

            session()->flash('message', 'User added successfully.');


            ActivityLog::add_log("Manager added - $request->name | $request->email");

            return redirect('/users');
        }

        return view("users.add.manager");
    }

    public function add_staff(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|unique:users|max:255',
                'name' => 'required',
                'departmentId' => 'required',
            ]);

            // add the new user
            User::create([
                'name' => $request->input("name"),
                'email' => $request->input("email"),
                'department_id' => $request->input("departmentId"),
                'role' => 'staff',
                'password' => Hash::make($request->input("Welcome@1234")),
            ]);

            session()->flash('message', 'User added successfully.');

            ActivityLog::add_log("Staff Member added - $request->name | $request->email | $request->departmentId");

            return redirect('/users');
        }
        $departments = Department::get();

        return view("users.add.staff", ['departments' => $departments]);
    }
}
