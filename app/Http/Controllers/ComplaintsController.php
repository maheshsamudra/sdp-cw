<?php

namespace App\Http\Controllers;

use App\Models\Complaints;

use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function view($id)
    {
        
        $complaint = Complaints::find($id);

        return view('complaints.view', [
            'complaint' => $complaint
        ]);
    }
}
