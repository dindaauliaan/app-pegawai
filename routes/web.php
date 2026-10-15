<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', function () {
    return view('welcome');
});

// ====================
// AUTHENTICATION
// ====================
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login')->with('success', 'Berhasil logout!');
})->name('logout');



// ====================
// PROTECTED ROUTES
// ====================
Route::middleware(['auth'])->group(function () {

    // === DASHBOARD ===
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/employees/dashboard', [EmployeeController::class, 'dashboard'])
        ->name('employees.dashboard');


    // ========================================
    // ABSENSI — ROUTE TAMBAHAN UNTUK DASHBOARD
    // ========================================

    // Check-in
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])
        ->name('attendance.checkin');

    // Check-out
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])
        ->name('attendance.checkout');

    // Riwayat Absensi Karyawan
    Route::get('/employees/attendance/history', [AttendanceController::class, 'history'])
        ->name('attendance.history');


    // ======================
    // CRUD ANNOUNCEMENTS
    // ======================
    Route::prefix('admin')->group(function () {
        Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
        Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');
        Route::post('/announcement', [AnnouncementController::class, 'store'])->name('announcement.store');
        Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
        Route::put('/announcement/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
        Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
    });
});


// ====================
// CRUD EMPLOYEE
// ====================
Route::resource('employees', EmployeeController::class);

// ====================
// CRUD DEPARTMENT
// ====================
Route::resource('department', DepartmentController::class);

// ====================
// CRUD SALARIES
// ====================
Route::resource('salaries', SalariesController::class);

// ====================
// CRUD POSITION
// ====================
Route::resource('position', PositionController::class);

// ====================
// CRUD ATTENDANCE (admin version)
// ====================
Route::get('attendance', [AttendanceController::class,'index'])->name('attendance.index');
Route::get('attendance/create', [AttendanceController::class,'create'])->name('attendance.create');
Route::post('attendance', [AttendanceController::class,'store'])->name('attendance.store');
Route::get('attendance/{id}/edit', [AttendanceController::class,'edit'])->name('attendance.edit');
Route::put('attendance/{id}', [AttendanceController::class,'update'])->name('attendance.update');
Route::delete('attendance/{id}', [AttendanceController::class,'destroy'])->name('attendance.destroy');
Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn'])
    ->name('attendance.checkin');

Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut'])
    ->name('attendance.checkout');

