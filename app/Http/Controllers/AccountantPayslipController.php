<?php

namespace App\Http\Controllers;

use App\Contracts\ILoggedService;
use App\Models\AccountantLogs;
use App\Models\AllowanceRecord;
use App\Models\AllowanceRecordEmployee;
use App\Models\DeductionRecord;
use App\Models\DeductionRecordEmployee;
use App\Models\Employees;
use App\Models\PayrollRecord;
use App\Models\taxes_record;
use Illuminate\Http\Request;

class AccountantPayslipController extends Controller
{
    protected $loggedService;

    public function __construct(ILoggedService $loggedService) {
        $this->loggedService = $loggedService;
    }



    public function payslip() {
        return view('UserTreasury.Payslip.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            "employees" => Employees::inRandomOrder()->get(),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }


    public function checkPayslipExistence(Request $request) {
        $payrollRecord = PayrollRecord::where('payroll_period', $request->payPeriod)->first();
        
        if(!$payrollRecord) {
            return response()->json([
                'status' => 401,
                'message' => 'error'
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }

    public function generatePayslip($ids, $payrollPeriod) {
        $employeeIds = json_decode($ids);

        return view('UserTreasury.Payslip.generatePayslip', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get(),
            'payrollPeriod' => $payrollPeriod,
            'ids' => $ids,
            "employees" => Employees::whereIn('id', $employeeIds)->get(),
            "payrollRecordsEmp" => PayrollRecord::whereIn('employee', $employeeIds)->where('payroll_period', $payrollPeriod)->get(),
            
            // Allowances
            "allowanceRecord" => AllowanceRecord::where('payroll_period', $payrollPeriod)->get(),
            "allowanceRecordSelf" => AllowanceRecordEmployee::whereIn('employee', $employeeIds)->where('payroll_period', $payrollPeriod)->get(),

            //Deductions and Taxes
            "deductionRecord" => DeductionRecord::where('payroll_period', $payrollPeriod)->get(),
            "deductionRecordSelf" => DeductionRecordEmployee::whereIn('employee', $employeeIds)->where('payroll_period', $payrollPeriod)->get(),
            "taxRecord" => taxes_record::where('payroll_period', $payrollPeriod)->get()
        ]);
    }
}