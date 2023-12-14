<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view()
    {

        $staff = User::where('role', '=', 'staff')->get();
        $managers = User::where('role', '=', 'manager')->get();

        return view("users.view", [
            'staff' => $staff,
            'managers' => $managers
        ]);
    }

    public function view_user($id)
    {

        $user = User::find($id);

        return view("users.view-user", [
            'user' => $user,
        ]);
    }

    public function add_manager(Request $request)
    {

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'email' => 'required|unique:users|max:255',
                'name' => 'required',
            ]);

            // add the new user
            User::insert([
                'name' => $request->input("name"),
                'email' => $request->input("email"),
                'role' => 'manager',
                'password' => Hash::make($request->input("Welcome@1234")),
            ]);
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
            User::insert([
                'name' => $request->input("name"),
                'email' => $request->input("email"),
                'department_id' => $request->input("departmentId"),
                'role' => 'staff',
                'password' => Hash::make($request->input("Welcome@1234")),
            ]);
        }
        $departments = Department::get();
        return view("users.add.staff", ['departments' => $departments]);
    }
}
