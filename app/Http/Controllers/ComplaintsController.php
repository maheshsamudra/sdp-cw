<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\ComplaintLog;
use App\Models\Complaints;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
use File;


class ComplaintsController extends Controller
{
    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'details' => 'required',
                'date' => 'required',
            ]);


            // add the new user
            $complaint = Complaints::create([
                'title' => $request->title,
                'details' => $request->details,
                'observed_date' => $request->date,
                'user_id' => Auth::user()->id
            ]);

            $images = $request->file('images');


            if ($complaint->id &&  $images) {
                // store the images


                foreach ($images as $key => $image) {
                    # code...
                    $ext = $image->getClientOriginalExtension();
                    Storage::disk('local')->put("complaints/$complaint->id/$key.$ext", file_get_contents($image));
                }
            }


            session()->flash('message', 'Complaint logged.');

            $user = Auth::user();


            ActivityLog::add_log("Complaint added by - $user->name | $user->email, complaint ID: $complaint->id");


            return redirect('/dashboard');
        }

        return view('complaints.add');
    }

    public function view($id)
    {

        $complaint = Complaints::find($id);

        $staff = User::select("users.*", 'departments.name as department_name')->where('role', '=', 'staff')->join('departments', 'users.department_id', '=', 'departments.id')
            ->get();

        $logs = ComplaintLog::where('complaint_id', $id)->orderBy('created_at', 'desc')->get();

        $images = Storage::files("complaints/$id");


        return view('complaints.view', [
            'complaint' => $complaint,
            'staff' => $staff,
            'logs' => $logs,
            'images' => $images
        ]);
    }

    public function view_all()
    {
        $complaints = Complaints::orderBy('observed_date', 'desc')->get();

        return view('complaints.all', [
            'complaints' => $complaints,
        ]);
    }

    public function assign($id, Request $request)
    {

        $complaint = Complaints::find($id);
        $complaint->assigned_staff_user_id = $request->user_id;

        $complaint->save();

        ActivityLog::add_log("Complaint assigned to - $request->user_id");

        session()->flash('message', 'Complaint assigned.');

        return redirect("/dashboard");
    }

    public function log($id, Request $request)
    {

        // $images = $request->file('images');

        // if ($images) {
        //     // upload
        //     $image = $request->file('file');
        //     $input['file'] = time() . '.' . $image->getClientOriginalExtension();

        //     $destinationPath = public_path('/thumbnail');
        //     $imgFile = Image::make($image->getRealPath());
        //     $imgFile->resize(150, 150, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($destinationPath . '/' . $input['file']);
        //     $destinationPath = public_path('/uploads');
        //     $image->move($destinationPath, $input['file']);
        // }


        // return;

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
