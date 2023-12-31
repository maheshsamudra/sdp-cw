<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Complaint;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    // log in
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $data = new \stdClass();

    $user = User::where('email', $request->email)->first();

    if ($user->role != "user") {
        $data->error = "The account type is not supported. Please use web app to login.";
        return $data;
    }

    if (
        !$user || !Hash::check($request->password, $user->password)
    ) {
        $data->error = "The provided credentials are incorrect.";
        return $data;
    }

    $data->user = $user;
    $data->token = $user->createToken($request->device_name)->plainTextToken;

    return $data;
});

Route::post('/register', function (Request $request) {
    // register
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'name' => 'required',
        'nic' => 'required',
        'dob' => 'required',
        'device_name' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'nic' => $request->nic,
        'dob' => $request->dob,
        'password' => Hash::make($request->password),
    ]);

    $data = new \stdClass();


    $user = User::where('email', $request->email)->first();

    $data->user = $user;
    $data->token = $user->createToken($request->device_name)->plainTextToken;

    return $data;
});

Route::middleware('auth:sanctum')->get('/complaints', function (Request $request) {
    // get all my complaints
    return Complaint::where('user_id', "=", $request->user()->id)->get();
});

Route::middleware('auth:sanctum')->get('/complaints/{id}', function ($id, Request $request) {
    // get complaint by id
    return Complaint::where('user_id', "=", $request->user()->id)->where('id', '=', $id)->first();
});

Route::middleware('auth:sanctum')->post('/complaints', function (Request $request) {

    // add complaints
    $complaint = Complaint::create([
        'department_id' => $request->department_id,
        'user_id' => $request->user()->id,
        'title' => $request->title,
        'observed_date' => $request->observed_date,
        'details' => $request->details,
    ]);

    // todo: upload the images and save to the DB

    return true;
});

Route::middleware('auth:sanctum')->post('/reset-forgotten-password', function (Request $request) {

    // add complaints
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return true;
});
