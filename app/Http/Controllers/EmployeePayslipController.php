<?php

namespace App\Http\Controllers;

use App\Models\AllowanceRecord;
use App\Models\AllowanceRecordEmployee;
use App\Models\DeductionRecord;
use App\Models\DeductionRecordEmployee;
use App\Models\employee_absent_deduction_records;
use App\Models\employee_overtime_records;
use App\Models\Employees;
use App\Models\PayrollRecord;
use App\Models\tax_record_employees;
use Illuminate\Http\Request;

class EmployeePayslipController extends Controller
{
    public function index() {
        $loggedEmployee = Employees::find(session('logged_employee'));
        return view('UserEmployees.Payslip.index', [
            'loggedEmployee' => $loggedEmployee
        ]);
    }

    public function checkPayslipExistence(Request $request) {
        $payrollRecord = PayrollRecord::where('payroll_period', $request->payPeriod)->where('employee', session('logged_employee'))->first();
        
        if(!$payrollRecord) {
            return response()->json([
                'status' => 401,
                'message' => 'You have no record for the period of '.$request->payPeriod.'.'
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }

    public function GeneratePayslip($payrollPeriod) {


        $loggedEmployee = Employees::find(session('logged_employee'));
        $employee = Employees::find(session('logged_employee'));

        $payrollRecordsEmp = PayrollRecord::where('employee', session('logged_employee'))->where('payroll_period', $payrollPeriod)->get();

        // Allowances
        $allowanceRecord = AllowanceRecord::where('payroll_period', $payrollPeriod)->get();
        $allowanceRecordSelf = AllowanceRecordEmployee::where('employee', session('logged_employee'))->where('payroll_period', $payrollPeriod)->get();

        //Deductions and Taxes
        $deductionRecord = DeductionRecord::where('payroll_period', $payrollPeriod)->get();
        $deductionRecordSelf = DeductionRecordEmployee::where('employee', session('logged_employee'))->where('payroll_period', $payrollPeriod)->get();

        $taxRecord = tax_record_employees::where('payroll_period', $payrollPeriod)->get();

        $deductions = DeductionRecord::where('payroll_period', $payrollPeriod)->get();

        $absentDeduction = employee_absent_deduction_records::where('payroll_period', $payrollPeriod)->get();
        $overtime = employee_overtime_records::where('payroll_period', $payrollPeriod)->get();


        return view('UserEmployees.Payslip.generatePayslip', [
            'loggedEmployee' => $loggedEmployee,
            'payrollPeriod' => $payrollPeriod,
            'ids' => session('logged_employee'),
            "employee" => $employee,
            "payrollRecordsEmp" => $payrollRecordsEmp,
            
            // Allowances
            "allowanceRecord" => $allowanceRecord,
            "allowanceRecordSelf" => $allowanceRecordSelf,

            //Deductions and Taxes
            "deductionRecord" => $deductionRecord,
            "deductionRecordSelf" => $deductionRecordSelf,
            "taxRecord" => $taxRecord,
            "deductions" => $deductions,
            "absentDeduction" => $absentDeduction,
            "overtime" => $overtime
        ]);
    }
}
