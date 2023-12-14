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

        $user_id = $user->id;

        $complaints = Complaint::when($isManager, function ($query) {
            $query->whereNull('assigned_staff_user_id');
        })->when($isStaff, function ($query, int $user_id) {
            $query->where('assigned_staff_user_id', $user_id)->whereNull('completed_at');
        })->get();


        return view("dashboard.{$user['role']}", [
            'data' => $data,
            'complaints' => $complaints
        ]);
    }
}
