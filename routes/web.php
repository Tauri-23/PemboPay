<?php

use App\Http\Controllers\AccountantEmployeesController;
use App\Http\Controllers\AccountantPaySettingsController;
use App\Http\Controllers\AccountantPayslipController;
use App\Http\Controllers\AccountantProfileController;
use App\Http\Controllers\AccountantReportController;
use App\Http\Controllers\AdminDashController;
use App\Http\Controllers\AdminDepartmentsController;
use App\Http\Controllers\AdminEmployeesController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\EmployeePayslipController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\RunPayrollController;
use App\Http\Controllers\TreasuriesController;
use App\Http\Controllers\TreasuryDashController;
use App\Http\Controllers\TreasuryDepartmentsController;
use App\Http\Controllers\TreasuryEmployeesController;
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
Route::post('/loginAccountantPost', [TreasuriesController::class, 'loginAccountantPost']);
Route::get('/loginTreasury', [TreasuriesController::class, 'loginTreasury']);
Route::get('/logoutTreasury', [TreasuriesController:: class, 'logout']);

Route::post('/forgotPassword', [ForgotPasswordController::class, 'forgotPasswordPost']);


//Home
Route::get('/TreasuryDashboard', [TreasuryDashController::class, 'home']);


// Profile
Route::get('/AccountantViewProfile/{id}', [AccountantProfileController::class, 'index']);
Route::post('/AccountantEditProfile', [AccountantProfileController::class, 'editProfilePost']);


//Run Payroll
Route::get('/TreasuryRunPayroll', [TreasuryDashController::class, 'runPayroll']);
Route::post('/AccountantProcessPayroll', [RunPayrollController::class, 'computePayroll']);
Route::post('/AccountantSaveDbPayroll', [RunPayrollController::class, 'addPayrollToDb']);


//Payroll History
Route::get('/TreasuryPayrollHistory', [TreasuryDashController::class, 'payrollHistory']);
Route::get('/viewFullPayrollHistory/{period}', [TreasuryDashController::class, 'fullPayrollHistory']);


//Reports
Route::get('/TreasuryReports', [AccountantReportController::class, 'reports']);
Route::get('/AccountantGenerateReport/{payrollPeriod}', [AccountantReportController::class, 'generateReports']);


//Payslip
Route::get('/TreasuryPayslip', [AccountantPayslipController::class, 'payslip']);
Route::get('/AccountantGeneratePayslip/{ids}/{payrollPeriod}', [AccountantPayslipController::class, 'generatePayslip']);
Route::post('/checkPayslipAvailability', [AccountantPayslipController::class, 'checkPayslipExistence']);


//Employees
Route::get('/TreasuryEmployees', [AccountantEmployeesController::class, 'employees']);
Route::get('/TreasuryViewEmployee/{id}/{timeSheetMonth}/{activePage}', [AccountantEmployeesController::class, 'viewEmployee']);


//Departments
Route::get('/TreasuryDepartments', [TreasuryDepartmentsController::class, 'departments']);
Route::get('/ViewDept/{id}', [TreasuryDepartmentsController::class, 'viewDepartment']);


//Payroll Settings
// Route::get('/AccountantPayrollSettings', [AccountantPaySettingsController::class, 'payrollSettings']);
// Route::get('/viewTaxTable/{id}', [AccountantPaySettingsController::class, 'viewTaxTable']);

// Route::post('/AddTaxPost', [AccountantPaySettingsController::class, 'AddTaxPost']);
// Route::post('/AccountantAddTaxCol', [AccountantPaySettingsController::class, 'addTaxColumnPost']);
// Route::post('/AccountantEditTaxCol', [AccountantPaySettingsController::class, 'editTaxColumnPost']);
// Route::post('/AccountantDelTaxCol', [AccountantPaySettingsController::class, 'delTaxColumnPost']);



// Route::post('/DelTaxPost', [AccountantPaySettingsController::class, 'DelTaxPost']);










/*
|----------------------------------------
| Employees Time in Time out
|----------------------------------------
*/
Route::get('/Employee', [EmployeesController::class, 'loginPage']);
Route::get('/EmployeeDash', [EmployeesController::class, 'dashboard']);

Route::post('/EmployeeLogin', [EmployeesController::class, 'login']);
Route::post('/timeIn', [EmployeesController::class, 'timeIn']);
Route::post('/timeOut', [EmployeesController::class, 'timeOut']);

// Timesheet
Route::get('/EmployeeTimesheet/{timeSheetMonth}', [EmployeesController::class, 'timesheet']);

// Payslip
Route::get('/EmployeePayslip', [EmployeePayslipController::class, 'index']);
Route::post('/EmployeecheckPayslipAvailability', [EmployeePayslipController::class, 'checkPayslipExistence']);
Route::get('/EmployeeGeneratePayslip/{payrollPeriod}', [EmployeePayslipController::class, 'GeneratePayslip']);

// Profile
Route::get('/EmployeeViewProfile/{id}', [EmployeesController::class, 'viewProfile']);


// Employee TimeIn/Out Express
Route::get('/EmployeeTimeIn', [EmployeesController::class, 'publicAttendance']);
Route::post('/timeInExpressPost', [EmployeesController::class, 'attendanceExpressPost']);












/*
|----------------------------------------
| Admin
|----------------------------------------
*/
// Dashboard
Route::get('/AdminDashboard', [AdminDashController::class, 'index']);

// Accountants
Route::get('/AdminAccountants', [AdminDashController::class, 'AccountantIndex']);
Route::get('/AdminViewAccountantProfile/{id}', [AdminDashController::class, 'AccountantView']);
Route::post('/AdminAddAccountant', [AdminDashController::class, 'AddAccountantPost']);
Route::post('/AdminDelAccountant', [AdminDashController::class, 'DelAccountant']);
Route::get('/AdminAccountantLogs', [AdminDashController::class, 'AccountantLogs']);


//Employees
Route::get('/AdminEmployees', [AdminEmployeesController::class, 'index']);
Route::get('/AdminAddEmployees/{deptId}', [AdminEmployeesController::class, 'addEmployee']);
Route::get('/AdminViewTreasury/{id}', [AdminEmployeesController::class, 'viewEmployee']);
Route::post('/AdminAddEmployeePost', [AdminEmployeesController::class, 'addEmployeePost']);
Route::post('/AdminEditEmpInfo', [AdminEmployeesController::class, 'editEmployeePost']);
Route::post('/DeleteEmployee', [AdminEmployeesController::class, 'deleteEmployeePost']);


// Departments
Route::get('/AdminDepartments', [AdminDepartmentsController::class, 'index']);
Route::get('/AdminAddDepartment', [AdminDepartmentsController::class, 'addDepartment']);
Route::get('/adminViewDept/{id}', [AdminDepartmentsController::class, 'viewDepartment']);
Route::get('/AdminDeptSettings/{id}', [AdminDepartmentsController::class, 'departmentSettings']);
Route::post('/AdminAddDepartmentPost', [AdminDepartmentsController::class, 'addDepartmentPost']);
Route::post('/AdminDeleteDepartment', [AdminDepartmentsController::class, 'deleteDepartment']);
Route::post('/adminAddDeptPos', [AdminDepartmentsController::class, 'addDeptPos']);
Route::post('/adminEditDeptPos', [AdminDepartmentsController::class, 'editDeptPos']);
Route::post('/adminDelDeptPos', [AdminDepartmentsController::class, 'delDeptPos']);
Route::post('/adminEditDeptInfo', [AdminDepartmentsController::class, 'editDeptInfo']);
Route::post('/adminEditDeptPicPost', [AdminDepartmentsController::class, 'editDeptPicPost']);



// Settings
Route::get('/AdminSettings/{page}', [AdminSettingsController::class, 'index']);
Route::get('/AdminViewTaxExemptTable/{id}', [AdminSettingsController::class, 'taxExemptTable']);

Route::post('/adminAddSalGrade', [AdminSettingsController::class, 'addSalGradePost']);
Route::post('/adminEditSalGrade', [AdminSettingsController::class, 'editSalGradePost']);
Route::post('/adminDelSalGrade', [AdminSettingsController::class, 'deleteSalGradePost']);

Route::post('/adminAddTaxExempt', [AdminSettingsController::class, 'addTaxExemptPost']);
Route::post('/adminDelTaxExemptPost', [AdminSettingsController::class, 'delTaxExemptPost']);

Route::post('/AdminAddTaxExemptRow', [AdminSettingsController::class, 'addTaxExemptRowPost']);
Route::post('/AdminEditTaxExemptRow', [AdminSettingsController::class, 'editTaxExemptRowPost']);
Route::post('/AdminDelTaxExemptRow', [AdminSettingsController::class, 'delTaxExemptRowPost']);

Route::post('/AddAllowancePost', [AdminSettingsController::class, 'AddAllowancePost']);
Route::post('/DelAllowancenPost', [AdminSettingsController::class, 'DelAllowancenPost']);



Route::post('/AddDeductionPost', [AdminSettingsController::class, 'AddDeductionsPost']);
Route::post('/DelDeductionPost', [AdminSettingsController::class, 'DelDeductionPost']);