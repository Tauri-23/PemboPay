<?php

namespace App\Http\Controllers;

use App\Contracts\ILoggedService;
use App\Models\AccountantLogs;
use App\Models\AllowanceRecord;
use App\Models\AllowanceRecordEmployee;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
use App\Models\tax_exempt;
use App\Models\tax_record_employees;
use App\Models\taxes_record;
use Illuminate\Http\Request;

class AccountantReportController extends Controller
{
    protected $loggedService;

    public function __construct(ILoggedService $loggedService) {
        $this->loggedService = $loggedService;
    }


    public function reports() {
        return view('UserTreasury.Reports.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function generateReports($payrollPeriod) {
        $payrollRecords = PayrollRecord::where('payroll_period', $payrollPeriod)->get();
        $allowanceRecords = AllowanceRecord::where('payroll_period', $payrollPeriod)->get();
        $allowanceRecordsEmp = AllowanceRecordEmployee::where('payroll_period', $payrollPeriod)->get();

        $taxes = tax_record_employees::where('payroll_period', $payrollPeriod)->get();

        $totalAllowance = PayrollRecord::where('payroll_period', $payrollPeriod)->get()->sum('allowance');
        $totalDeduction = PayrollRecord::where('payroll_period', $payrollPeriod)->get()->sum('deductions');
        $totalCompensation = PayrollRecord::where('payroll_period', $payrollPeriod)->get()->sum('net_pay');

        return view('UserTreasury.Reports.generateReport', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'payrollPeriod' => $payrollPeriod,
            'departments' => Departments::all(),
            'employees' => Employees::all(),
            'payrollRecords' => $payrollRecords,
            'allowanceRecords' => $allowanceRecords,
            'allowanceRecordsEmp' => $allowanceRecordsEmp,
            'totalAllowance' => $totalAllowance,
            'totalDeduction' => $totalDeduction,
            'totalCompensation' => $totalCompensation,
            'payrollRecordSummary' => PayrollRecordSummary::where('payroll_period', $payrollPeriod),
            'taxes' => $taxes,
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
