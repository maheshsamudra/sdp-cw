<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\User;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function view($id)
    {

        $complaint = Complaints::find($id);

        $staff = User::select("users.*", 'departments.name as department_name')->where('role', '=', 'staff')->join('departments', 'users.department_id', '=', 'departments.id')
            ->get();


        return view('complaints.view', [
            'complaint' => $complaint,
            'staff' => $staff
        ]);
    }

    public function assign($id, Request $request)
    {

        $complaint = Complaints::find($id);
        $complaint->assigned_staff_user_id = $request->user_id;

        $complaint->save();

        return redirect("/dashboard");
    }
}
