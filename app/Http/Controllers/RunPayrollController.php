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


    public function computePayroll() {
        return $this->computePayroll()->process();
    }
}
