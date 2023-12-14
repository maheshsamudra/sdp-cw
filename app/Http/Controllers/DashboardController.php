<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $data = [];
        $user = Auth::user();

        $unassigned_complaints = Complaint::whereNull('assigned_staff_user_id')->get();


        return view("dashboard.{$user['role']}", [
            'data' => $data,
            'unassigned_complaints' => $unassigned_complaints
        ]);
    }
}
