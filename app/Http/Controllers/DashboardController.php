<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $data = [];
        $user = Auth::user();

        return view("dashboard.{$user['role']}", [
            'data' => $data
        ]);
    }
}
