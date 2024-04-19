<?php

namespace App\Http\Controllers;

use App\Contracts\ILoggedService;
use App\Models\Treasuries;

class TreasuryDashController extends Controller
{
    protected $loggedService;

    public function __construct(ILoggedService $loggedService) {
        $this->loggedService = $loggedService;
    }


    public function home(){
        return view('UserTreasury.index', ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }

    public function runPayroll() {
        return view('UserTreasury.RunPayroll.index', ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }

    public function payrollHistory() {
        return view('UserTreasury.PayrollHistory.index', ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }

    public function reports() {
        return view('UserTreasury.Reports.index', ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }

    public function payslip() {
        return view('UserTreasury.Payslip.index', ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }

    public function payrollSettings() {
        return view('UserTreasury.PayrollSettings.index', ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }

}
