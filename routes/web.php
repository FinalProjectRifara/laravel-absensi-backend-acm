<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
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

// Route::get('/', function () {
//     return view('pages.auth.login');
// });

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.main');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Route::get('home', function () {
    //     return view('pages.dashboard', ['type_menu' => 'dashboard']);
    // })->name('home');

    Route::get('home', [UserController::class, 'dashboard'])->name('home');

    // // User Controller
    // Route::resource('users', UserController::class);

    // // Company Controller
    // Route::resource('companies', CompanyController::class);

    // // Attendance Controller
    // Route::resource('attendances', AttendanceController::class);

    // // Permission Controller
    // Route::resource('permissions', PermissionController::class);

    // // Cuti Controller
    // Route::resource('cutis', CutiController::class);

    // Routes that only ADMIN can access
    Route::middleware(['check.admin'])->group(function () {
        // User Controller
        Route::resource('users', UserController::class);

        // Company Controller
        Route::resource('companies', CompanyController::class);

        // Attendance Controller
        Route::resource('attendances', AttendanceController::class);

        // Permission Controller
        Route::resource('permissions', PermissionController::class);

        // Cuti Controller
        Route::resource('cutis', CutiController::class);
    });
});
