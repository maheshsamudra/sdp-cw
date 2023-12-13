<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::match(['get', 'post'], '/users/staff/add', [UserController::class, 'add_staff'])->middleware(['auth', 'verified'])->name('add_staff');
Route::match(['get', 'post'], '/users/manager/add', [UserController::class, 'add_manager'])->middleware(['auth', 'verified'])->name('add_manager');


// Complaints Page Route
Route::get('/complaint', function () {
    return view('complaint');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
