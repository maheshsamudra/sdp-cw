<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/complaints/view/{id}', [ComplaintsController::class, 'view']);

Route::get('/dashboard', [DashboardController::class, 'view'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [UserController::class, 'view'])->middleware(['auth', 'verified'])->name('users');
Route::get('/users/{id}', [UserController::class, 'view_user'])->middleware(['auth', 'verified'])->name('view_user');
Route::get('/users/{id}/suspend', [UserController::class, 'suspend'])->middleware(['auth', 'verified']);
Route::get('/users/{id}/reactivate', [UserController::class, 'reactivate'])->middleware(['auth', 'verified']);

Route::match(['get', 'post'], '/users/staff/add', [UserController::class, 'add_staff'])->middleware(['auth', 'verified'])->name('add_staff');
Route::match(['get', 'post'], '/users/manager/add', [UserController::class, 'add_manager'])->middleware(['auth', 'verified'])->name('add_manager');


// Complaints Page Route
Route::get('/complaints/{id}', [ComplaintsController::class, 'view'])->middleware(['auth', 'verified']);
Route::get('/complaint', [ComplaintsController::class, 'add'])->middleware(['auth', 'verified']);
Route::post('/complaints/{id}/assign', [ComplaintsController::class, 'assign'])->middleware(['auth', 'verified']);
Route::post('/complaints/{id}/log', [ComplaintsController::class, 'log'])->middleware(['auth', 'verified']);
Route::get('/complaints/{id}/complete', [ComplaintsController::class, 'complete'])->middleware(['auth', 'verified']);



Route::get('/image/{category}/{folder}/{filename}.jpg', [ImageController::class, 'view'])->middleware(['auth', 'verified'])->name('view_image');
Route::get('/activity-log', function () {

    $logs = ActivityLog::select('activity_logs.*', 'users.id', 'users.name', 'users.email')
        ->join('users', 'users.id', 'activity_logs.user_id')->orderBy('created_at', 'desc')->get();


    return view("activity-log", ['logs' => $logs]);
})->middleware(['auth', 'verified'])->name('view_activity_logs');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
