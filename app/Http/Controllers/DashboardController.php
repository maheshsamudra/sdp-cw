<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Database\Query\Builder;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $data = [];
        $user = Auth::user();

        $isManager = $user->role == 'manager';
        $isStaff = $user->role == 'staff';
        $isUser = $user->role == "user";

        $complaints = Complaint::when($isManager, function ($query) {
            $query->whereNull('assigned_staff_user_id');
        })->when($isStaff, function ($query) {
            $query->where('assigned_staff_user_id', Auth::user()->id)->whereNull('completed_at');
        })->when($isUser, function ($query) {
            $query->where('user_id', Auth::user()->id)->whereNull('completed_at');
        })->orderBy('observed_date', 'desc')->get();

        $completed_complaints = Complaint::whereNotNull('completed_at')
            ->when($isStaff, function ($query) {
                $query->where('assigned_staff_user_id', Auth::user()->id);
            })->when($isUser, function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get();


        return view("dashboard.{$user['role']}", [
            'data' => $data,
            'complaints' => $complaints,
            'completed_complaints' => $completed_complaints
        ]);
    }
}
