<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    return view('index');
});

/*
|----------------------------------------
| Treasury
|----------------------------------------
*/

//Login
Route::post('/', [AuthController::class, 'login'])->name('auth.login');


//Home
Route::get('/TreasuryDashboard', function() {
    return view('UserTreasury.index');
});



//Run Payroll
Route::get('/TreasuryRunPayroll', function() {
    return view('UserTreasury.RunPayroll.index');
});



//Payroll History
Route::get('/TreasuryPayrollHistory', function() {
    return view('UserTreasury.PayrollHistory.index');
});



//Reports
Route::get('/TreasuryReports', function() {
    return view('UserTreasury.Reports.index');
});



//Payslip
Route::get('/TreasuryPayslip', function() {
    return view('UserTreasury.Payslip.index');
});



//Employees
Route::get('/TreasuryEmployees', function() {
    return view('UserTreasury.Employees.index');
});



//Departments
Route::get('/TreasuryDepartments', function() {
    return view('UserTreasury.Departments.index');
});


