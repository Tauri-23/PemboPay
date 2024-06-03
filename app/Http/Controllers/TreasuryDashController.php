<?php

namespace App\Http\Controllers;

use App\Contracts\ILoggedService;
use App\Models\AccountantLogs;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
use App\Models\Treasuries;

class TreasuryDashController extends Controller
{
    protected $loggedService;

    public function __construct(ILoggedService $loggedService) {
        $this->loggedService = $loggedService;
    }


    public function home(){
        $empSalaries = PayrollRecordSummary::all();

        $totalSal = $empSalaries->sum('total_net_pay');
        
        return view('UserTreasury.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            "employees" => Employees::all(),
            "departments" => Departments::all(),
            'empSalaries' => $empSalaries,
            'payrollRecordsEmp' => PayrollRecord::with('employee')->get(),
            'Recentpayrolls' => PayrollRecordSummary::orderBy('created_at', 'DESC')->take(5)->get(),
            'totalSal' => $totalSal,
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function runPayroll() {
        return view('UserTreasury.RunPayroll.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function payrollHistory() {
        return view('UserTreasury.PayrollHistory.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'payrolls' => PayrollRecordSummary::orderBy('created_at', 'DESC')->get(),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function fullPayrollHistory($period) {
        return view('UserTreasury.PayrollHistory.viewFullPayrollHistory', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'payrolls' => PayrollRecord::orderBy('created_at', 'DESC')->where('payroll_period', $period)->get(),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get(),
            'period' => $period
        ]);
    }
}
