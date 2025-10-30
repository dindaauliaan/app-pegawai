<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\AttendanceController;
Route::get('/', function () {
    return view('welcome');
});
//CRUD employee
//create
Route::get('employees/create',[EmployeeController::class,'create'])->name('employees.create');
Route::post('employees',[EmployeeController::class,'store']);
//read
Route::get('/employees',[EmployeeController::class,'index'])->name('employees.index');
Route::get('/employees/{id}',[EmployeeController::class,'show'])->name('employees.show');
//update
Route::get('/employees/{id}/edit',[EmployeeController::class,'edit'])->name('employees.edit');
Route::put('/employees/{id}',[EmployeeController::class,'update']);
//delete
Route::delete('/employees/{id}',[EmployeeController::class,'destroy'])->name('employees.destroy');

//CRUD department
//create
Route::get('department/create',[DepartmentController::class,'create'])->name('department.create');;
Route::post('department',[DepartmentController::class,'store']);
//Read
Route::get('department',[DepartmentController::class,'index'])->name('department.index');
Route::get('/employees/{id}',[EmployeeController::class,'show'])->name('employees.show');
//update
Route::get('/department/{id}/edit',[DepartmentController::class,'edit'])->name('department.edit');
Route::put('/department/{id}',[DepartmentController::class,'update']);
//delete
Route::delete('/department/{id}',[DepartmentController::class,'destroy'])->name('department.destroy');

// CRUD Salaries
//create
Route::get('salaries/create',[SalariesController::class,'create'])->name('salaries.create');
Route::post('salaries',[SalariesController::class,'store'])->name('salaries.store');
//read
Route::get('salaries',[SalariesController::class,'index'])->name('salaries.index');
Route::get('/salaries/{id}',[SalariesController::class,'show'])->name('salaries.show');
//update
Route::get('/salaries/{id}/edit',[SalariesController::class,'edit'])->name('salaries.edit');
Route::put('/salaries/{id}',[SalariesController::class,'update']);
//delete
Route::delete('/salaries/{id}',[SalariesController::class,'destroy'])->name('salaries.destroy');

//CRUD position
//create
Route::get('position/create',[PositionController::class,'create'])->name('position.create');
Route::post('position',[PositionController::class,'store']);
//read
Route::get('position',[PositionController::class,'index'])->name('position.index');
Route::get('/position/{id}',[PositionController::class,'show'])->name('position.show');
//update
Route::get('/position/{id}/edit',[PositionController::class,'edit'])->name('position.edit');
Route::put('/position/{id}',[PositionController::class,'update']);
//delete
Route::delete('/position/{id}',[PositionController::class,'destroy'])->name('position.destroy');

//CRUD attendance
//create
Route::get('attendance/create',[AttendanceController::class,'create'])->name('attendance.create');
Route::post('attendance',[AttendanceController::class,'store'])->name('attendance.store');

//read
Route::get('attendance',[AttendanceController::class,'index'])->name('attendance.index');
Route::get('/attendance/{id}',[AttendanceController::class,'show'])->name('attendance.show');

//update
Route::get('/attendance/{id}/edit',[AttendanceController::class,'edit'])->name('attendance.edit');
Route::put('/attendance/{id}',[AttendanceController::class,'update'])->name('attendance.update');

//delete
Route::delete('/attendance/{id}',[AttendanceController::class,'destroy'])->name('attendance.destroy');
