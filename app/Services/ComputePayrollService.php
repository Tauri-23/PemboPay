<?php
namespace App\Services;

use App\Contracts\IComputePayrollService;
use App\Contracts\IGenerateIdService;
use App\Models\AllowanceRecord;
use App\Models\employee_allowance;
use App\Models\employee_deductions;
use App\Models\Employees;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\SettingsPayrollPeriod;
use App\Models\timesheet;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class ComputePayrollService implements IComputePayrollService {

    //Services
    protected $generateId;

    //
    private $employees;
    private $timesheet;
    private $settingsPayrollPeriod;
    private $generalAllowance;
    private $selfAllowance;
    private $generalDeduction;
    private $selfDeduction;

    private $payrollRecordSummaries;


    private $temp_payroll_records = [];
    private $temp_payroll_record_summaries = [];

    public function __construct(IGenerateIdService $generateId) {
        $this->generateId = $generateId;
    }

    public function process($month, $period, $year) {

        $this->settingsPayrollPeriod = SettingsPayrollPeriod::first(); //Payroll Settings Configurations


        $payrollPeriod = $period." ".date('M', mktime(0, 0, 0, $month, 1))." ".$year;

        $computedPayrollPeriod = $this->ComputePayrollPeriod($month, $period, $year); //Start and End Date of Payroll Based on the Cutoff

        $this->payrollRecordSummaries = PayrollRecordSummary::where("payroll_period", $payrollPeriod)->first(); //payroll summaries from database


        //Check if payroll existing Yes?Return and not continue
        if($this->payrollRecordSummaries != null) {
            return response()->json([
                "status" => 401,
                "message" => "There is already a record for the Period of {$payrollPeriod}"]
            );
        }

        $this->ProcessPayroll($computedPayrollPeriod, $payrollPeriod, $year);
        return response()->json([
            "status" => 200,
            "temp_payroll_records" => $this->temp_payroll_records,
            "temp_payroll_record_summaries" => $this->temp_payroll_record_summaries,
            "period" => $payrollPeriod
        ]);
    }





    // This Function is responsible for computing the Start Date and End Date
    function ComputePayrollPeriod($month, $period, $year) {
        $startDate = null;
        $endDate = null;
        if($period == "1-15") {
            $startDate = Carbon::create($year, $month, 1)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);

            //Adjust start date to nearest Sunday before the 1st
            while($startDate->day > 1 && $startDate->dayOfWeek === Carbon::SUNDAY) {
                $startDate->subDay();
            }

            //Calculate end date for period "1-15"
            $endDate = Carbon::create($year, $month, 15)
                ->addDay()
                ->subSeconds(1) // Subtract one second to get the last second of the 15th
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);

            // Adjust end date to nearest Sunday before the 15th if necessary
            while($endDate->day > 1 && $endDate->dayOfWeek === Carbon::SUNDAY) {
                $endDate->subDay();
            }
        }
        elseif($period == "16-30") {
            // Calculate start date for period "16-30"
            $startDate = Carbon::create($year, $month, 16)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
            
            // Adjust start date to nearest Sunday before the 16th if necessary
            while ($startDate->day > 1 && $startDate->dayOfWeek === Carbon::SUNDAY) {
                $startDate->subDay();
            }

            // Calculate end date for period "16-30"
            $endDate = Carbon::create($year, $month, Carbon::createFromDate($year, $month)->daysInMonth)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);

            // Adjust end date to nearest Sunday before the last day of the month if necessary
            while ($endDate->day > 1 && $endDate->dayOfWeek === Carbon::SUNDAY) {
                $endDate->subDay();
            }
        }

        return [
            'startDate' => $startDate->format('Y-m-d H:i:s'),
            'endDate' => $endDate->format('Y-m-d H:i:s'),
        ];
    }

    
    /*
    |----------------------------------------
    | Process the payroll
    |----------------------------------------
    */
    function ProcessPayroll($computedPayrollPeriod, $payrollPeriod, $year) {

        $startDate = Carbon::parse($computedPayrollPeriod['startDate']);
        $endDate = Carbon::parse($computedPayrollPeriod['endDate']);

        //Populate Properties
        $this->employees = Employees::all(); // Get All Employees
        $this->timesheet = timesheet::where(function($query) use ($startDate) {
            $query->where(DB::raw('DATE(time_in)'), '>=', $startDate->toDateString());
        })
        ->where(function ($query) use ($endDate) {
            $query->where(DB::raw('DATE(time_in)'), '<=', $endDate->toDateString());
        })
        ->whereYear('time_in', $year)
        ->get(); //get the timesheet that meet the payroll period
        $this->generalAllowance = settings_allowance::all(); //Get General allowance
        $this->selfAllowance = employee_allowance::all(); //Get Self Allowance
        $this->generalDeduction = SettingsDeductions::all(); //Get General Deductions
        $this->selfDeduction = employee_deductions::all(); //Get Self Deductions

        $totalHoursWorkedSummary = 0.0;
        $totalDeductionsSummary = 0.0;
        $totalAllowanceSummary = 0.0;
        $totalBasicPaySummary = 0.0;
        $totalGrossPaySummary = 0.0; 
        $totalNetPaySummary = 0.0;

        



        foreach($this->employees as $emp) {

            //For Payroll Records
            $hoursWorked = $this->GetHoursWorked($emp->id);
            $basicPay = $emp->compensation()->first()->compentsation_type == "salary" ? $emp->compensation()->first()->value / 2 : $emp->compensation()->first()->value * $hoursWorked;

            $genAllowance = $this->GetGeneralAllowance($basicPay);
            $selfAllowance = $this->GetSelfAllowance($emp->id, $basicPay);
            $totalAllowance = $genAllowance + $selfAllowance;

            $genDeductions = $this->GetGeneralDeductions($basicPay);
            $selfDeductions = $this->GetSelfDeductions($emp->id, $basicPay);
            $totalDeductions = $genDeductions + $selfDeductions;

            $grossPay = $basicPay + $totalAllowance;
            $netPay = $grossPay - $totalDeductions;


            //For Payroll Summary
            $totalHoursWorkedSummary += $hoursWorked;
            $totalDeductionsSummary += $totalDeductions;
            $totalAllowanceSummary += $totalAllowance;
            $totalBasicPaySummary += $basicPay;
            $totalGrossPaySummary += $grossPay;
            $totalNetPaySummary += $netPay;
            
            $temp_payroll_record = [
                "id" => $this->generateId->generate(PayrollRecord::class),
                "payroll_period" => $payrollPeriod,
                "employee" => $emp->id,
                "department" => $emp->department()->first()->department_name,
                "compensation_type" => $emp->compensation()->first()->compentsation_type,
                "hours_worked" => $hoursWorked,
                "deductions" => $totalDeductions,
                "allowance" => $totalAllowance,
                "gross_pay" => $grossPay,
                "net_pay" => $netPay,
                "basic_pay" => $basicPay
            ];

            $this->temp_payroll_records[] = $temp_payroll_record;
        }
        $temp_payroll_record_summary = [
            "id" => $this->generateId->generate(PayrollRecordSummary::class),
            "payroll_period" => $payrollPeriod,
            "total_hours_worked" => $totalHoursWorkedSummary,
            "total_deductions" => $totalDeductionsSummary,
            "total_allowance" => $totalAllowanceSummary,
            "total_basic_pay" => $totalBasicPaySummary,
            "total_gross_pay" => $totalGrossPaySummary,
            "total_net_pay" => $totalNetPaySummary            
        ];

        $this->temp_payroll_record_summaries[] = $temp_payroll_record_summary;
    }
    



    
    /*
    |----------------------------------------
    | Compute the Total Hours of the selected user 
    |----------------------------------------
    */
    function GetHoursWorked($id) {
        if($id === null) {
            return 0;
        }

        $timeSheet = $this->timesheet->where("employee", $id);

        if($timeSheet == null) {
            return 0;
        }

        $hoursWorked = $timeSheet->sum(function ($timeSheet) {
             $timeIn = Carbon::parse($timeSheet->time_in);
             $timeOut = Carbon::parse($timeSheet->time_out);

             $hours = ($timeOut->diffInMinutes($timeIn) / 60) -1;

             return $hours;
        });

        return $hoursWorked;
    }

    



    /*
    |----------------------------------------
    | Allowances And Deductions
    |----------------------------------------
    */
    function GetGeneralAllowance($basicPay) {
        $totalAllowance = 0.0;

        if($this->generalAllowance == null) {
            return $totalAllowance;
        }

        foreach($this->generalAllowance as $allowance) {
            if($allowance->type == "Amount") {
                $totalAllowance += $allowance->period == "Monthly" ? $allowance->price / 2 : $allowance->price;
            }
            else {
                $totalAllowance += $allowance->period == "Monthly" ? (($allowance->price / 2) * $basicPay) / 100 : ($allowance->price * $basicPay) / 100;
            }
        }

        return $totalAllowance;
    }

    function GetSelfAllowance($id, $basicPay) {
        $totalAllowance = 0.0;

        if($this->selfAllowance == null) {
            return $totalAllowance;
        }

        foreach($this->selfAllowance as $allowance) {
            if($allowance->employee == $id) {
                $totalAllowance += $allowance->allowance_period == "Monthly" ? $allowance->allowance_price / 2 : $allowance->allowance_price;
            }
            else {
                $totalAllowance += $allowance->allowance_period == "Monthly" ? (($allowance->allowance_price / 2) * $basicPay) / 100 : ($allowance->allowance_price * $basicPay) / 100;
            }
        }

        return $totalAllowance;
    }

    function GetGeneralDeductions($basicPay) {
        $totalDeductions = 0.0;

        if($this->generalDeduction == null) {
            return $totalDeductions;
        }

        foreach($this->generalDeduction as $deduction) {
            if($deduction->type == "Amount") {
                $totalDeductions += $deduction->period == "Monthly" ? $deduction->price / 2 : $deduction->price;
            }
            else {
                $totalDeductions += $deduction->period == "Monthly" ? (($deduction->price / 2) * $basicPay) / 100 : ($deduction->price * $basicPay) / 100;
            }
        }

        return $totalDeductions;
    }

    function GetSelfDeductions($id, $basicPay) {
        $totalDeductions = 0.0;

        if($this->selfDeduction == null) {
            return $totalDeductions;
        }

        foreach($this->selfDeduction as $deduction) {
            if($deduction->employee == $id) {
                $totalDeductions += $deduction->deduction_period == "Monthly" ? $deduction->deduction_price / 2 : $deduction->deduction_price;
            }
            else {
                $totalDeductions += $deduction->deduction_period == "Monthly" ? (($deduction->deduction_price / 2) * $basicPay) / 100 : ($deduction->deduction_price * $basicPay) / 100;
            }
        }

        return $totalDeductions;
    }




}