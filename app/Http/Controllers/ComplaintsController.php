<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\ComplaintLog;
use App\Models\Complaints;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function view($id)
    {

        $complaint = Complaints::find($id);

        $staff = User::select("users.*", 'departments.name as department_name')->where('role', '=', 'staff')->join('departments', 'users.department_id', '=', 'departments.id')
            ->get();

        $logs = ComplaintLog::where('complaint_id', $id)->get();


        return view('complaints.view', [
            'complaint' => $complaint,
            'staff' => $staff,
            'logs' => $logs
        ]);
    }

    public function assign($id, Request $request)
    {

        $complaint = Complaints::find($id);
        $complaint->assigned_staff_user_id = $request->user_id;

        $complaint->save();

        ActivityLog::add_log("Complaint assigned to - $request->user_id");

        return redirect("/dashboard");
    }

    public function log($id, Request $request)
    {

        $complaint = ComplaintLog::create([
            'complaint_id' => $id,
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
        ]);

        ActivityLog::add_log("Progress updated for complaint id - $id");


        return back();
    }

    public function complete($id, Request $request)
    {

        $complaint = Complaints::find($id);
        $complaint->completed_at = now();

        $complaint->save();

        ActivityLog::add_log("Complaint marked as completed - $id");

        return back();
    }
}
