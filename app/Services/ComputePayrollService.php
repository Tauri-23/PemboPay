<?php
namespace App\Services;

use App\Contracts\IComputePayrollService;
use App\Models\Employees;
use App\Models\timesheet;

class ComputePayrollService implements IComputePayrollService {

    //
    private $employees;
    private $timesheet;

    public function process() {
        $this->employees = Employees::all();
        $this->timesheet = timesheet::all();

        foreach($this->employees as $emp) {
            if($emp->compensation()->first()->compensation_type == "salary") {
                $salary = $emp->compensation()->first()->value;
                dd($salary);

            }
            else {

            }
        }
    }


}