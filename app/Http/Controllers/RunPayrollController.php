<?php

namespace App\Http\Controllers;

use App\Contracts\IComputePayrollService;
use Illuminate\Http\Request;

class RunPayrollController extends Controller
{
    protected $computePayroll;
    public function __construct(IComputePayrollService $computePayroll) {
        $this->computePayroll = $computePayroll;
    }


    public function computePayroll(Request $request) {
        return $this->computePayroll->process($request->month, $request->period, $request->year);
    }
}
