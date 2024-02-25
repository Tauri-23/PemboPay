<?php

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
Route::get('/TreasuryDashboard', function() {
    return view('UserTreasury.index');
});

Route::get('/TreasuryRunPayroll', function() {
    return view('UserTreasury.RunPayroll.index');
});

Route::get('/TreasuryPayrollHistory', function() {
    return view('UserTreasury.PayrollHistory.index');
});

Route::get('/TreasuryReports', function() {
    return view('UserTreasury.Reports.index');
});

Route::get('/TreasuryPayslip', function() {
    return view('UserTreasury.Payslip.index');
});

Route::get('/TreasuryEmployees', function() {
    return view('UserTreasury.Employees.index');
});


