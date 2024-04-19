<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TreasuriesController;
use App\Http\Controllers\TreasuryDashController;
use App\Http\Controllers\TreasuryDepartmentsController;
use App\Http\Controllers\TreasuryEmployeesController;
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
Route::post('/loginTreasury', [TreasuriesController::class, 'login']);
Route::get('/logoutTreasury', [TreasuriesController:: class, 'logout']);


//Home
Route::get('/TreasuryDashboard', [TreasuryDashController::class, 'home']);



//Run Payroll
Route::get('/TreasuryRunPayroll', [TreasuryDashController::class, 'runPayroll']);



//Payroll History
Route::get('/TreasuryPayrollHistory', [TreasuryDashController::class, 'payrollHistory']);



//Reports
Route::get('/TreasuryReports', [TreasuryDashController::class, 'reports']);



//Payslip
Route::get('/TreasuryPayslip', [TreasuryDashController::class, 'payslip']);



//Employees
Route::get('/TreasuryEmployees', [TreasuryEmployeesController::class, 'employees']);
Route::get('/TreasuryAddEmployees', [TreasuryEmployeesController::class, 'addEmployee']);
Route::post('/TreasuryAddEmployeePost', [TreasuryEmployeesController::class, 'addEmployeePost']);
Route::get('/TreasuryViewEmployee/{id}', [TreasuryEmployeesController::class, 'viewEmployee']);



//Departments
Route::get('/TreasuryDepartments', [TreasuryDepartmentsController::class, 'departments']);
Route::get('/TreasuryAddDepartments', [TreasuryDepartmentsController::class, 'addDepartments']);
Route::get('/ViewDept/{id}', [TreasuryDepartmentsController::class, 'viewDepartment']);
Route::post('/TreasuryAddDepartmentPost', [TreasuryDepartmentsController::class, 'addDepartmentPost']);
Route::post('/TreasuryDeleteDepartment', [TreasuryDepartmentsController::class, 'deleteDepartment']);



//Payroll Settings
Route::get('/AccountantPayrollSettings', [TreasuryDashController::class, 'payrollSettings']);


