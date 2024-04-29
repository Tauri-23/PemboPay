<?php
namespace App\Services;

use App\Contracts\IComputePayrollService;
use App\Contracts\IGenerateIdService;
use App\Models\AllowanceRecord;
use App\Models\AllowanceRecordEmployee;
use App\Models\DeductionRecord;
use App\Models\DeductionRecordEmployee;
use App\Models\employee_allowance;
use App\Models\employee_deductions;
use App\Models\Employees;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\SettingsPayrollPeriod;
use App\Models\taxes;
use App\Models\taxes_record;
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
    private $generalTaxes;

    private $payrollRecordSummaries;


    private $temp_payroll_records = [];
    private $temp_payroll_record_summaries = [];
    private $temp_allowance_records = [];
    private $temp_allowance_records_employees = [];
    private $temp_deduction_records = [];
    private $temp_deduction_records_employees = [];
    private $temp_taxes_records = [];

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
            "temp_allowance_records" => $this->temp_allowance_records,
            "temp_allowance_records_employees" => $this->temp_allowance_records_employees,
            "temp_deduction_records" => $this->temp_deduction_records,
            "temp_deduction_records_employees" => $this->temp_deduction_records_employees,
            "temp_taxes_records" => $this->temp_taxes_records,
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
        $this->generalTaxes = taxes::all(); //Get Taxes

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
            $genTax = $this->GetGeneralTax($basicPay);
            $totalDeductions = $genDeductions + $selfDeductions + $genTax;

            $grossPay = $basicPay + $totalAllowance;
            $netPay = $grossPay - $totalDeductions;


            //For Payroll Summary
            $totalHoursWorkedSummary += $hoursWorked;
            $totalDeductionsSummary += $totalDeductions;
            $totalAllowanceSummary += $totalAllowance;
            $totalBasicPaySummary += $basicPay;
            $totalGrossPaySummary += $grossPay;
            $totalNetPaySummary += $netPay;
            
            //payroll record per employee
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

            
            $this->getAllowanceRecordEmp($emp->id, $payrollPeriod); //Allowance Record specific employee
            $this->getDeductionRecordEmp($emp->id, $payrollPeriod); //Deduction Record specific employee
            $this->temp_payroll_records[] = $temp_payroll_record; //Payroll Record specific employee
        }

        //payroll record overall
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

        //allowance record overall
        foreach($this->generalAllowance as $allowance) {
            $temp_allowance_record = [
                "id" => $this->generateId->generate(AllowanceRecord::class),
                "payroll_period" => $payrollPeriod,
                "allowance_name" => $allowance->name,
                "allowance_price" => $allowance->period == "Monthly" ? $allowance->price / 2 : $allowance->price,
                "allowance_type" => $allowance->type
            ];

            $this->temp_allowance_records[] = $temp_allowance_record;
        }

        //deduction record overall
        foreach($this->generalDeduction as $deduction) {
            $temp_deduction_record = [
                "id" => $this->generateId->generate(DeductionRecord::class),
                "payroll_period" => $payrollPeriod,
                "deduction_name" => $deduction->name,
                "deduction_price" => $deduction->period == "Monthly" ? $deduction->price / 2 : $deduction->price,
                "deduction_type" => $deduction->type
            ];
            $this->temp_deduction_records[] = $temp_deduction_record;
        }

        //tax record overall
        foreach($this->generalTaxes as $tax) {
            $temp_tax_record = [
                "id" => $this->generateId->generate(taxes_record::class),
                "payroll_period" => $payrollPeriod,
                "tax_name" => $tax->name,
                "tax_price" => $tax->period == "Monthly" ? $tax->price / 2 : $tax->price,
                "tax_type" => $tax->type
            ];
            $this->temp_taxes_records[] = $temp_tax_record;
        }

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
    | Allowances And Deductions | Tax for computation
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

    function GetGeneralTax($basicPay) {
        $totalTax = 0.0;

        if($this->generalTaxes == null) {
            return $totalTax;
        }

        foreach($this->generalTaxes as $taxes) {
            if($taxes->type == "Amount") {
                $totalTax += $taxes->period == "Monthly" ? $taxes->price / 2 : $taxes->price;
            }
            else {
                $totalTax += $taxes->period == "Monthly" ? (($taxes->price / 2) * $basicPay) / 100 : ($taxes->price * $basicPay) / 100;
            }
        }

        return $totalTax;
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





    /*
    |----------------------------------------
    | Allowances And Deductions | Tax for Record
    |----------------------------------------
    */
    function getAllowanceRecordEmp($empId, $payrollPeriod) {
        foreach($this->selfAllowance as $allowance) {
            if($allowance != $empId) {
                continue;
            }
            $temp_allowance_record_employee = [
                "id" => $this->generateId->generate(AllowanceRecordEmployee::class),
                "employee" => $empId,
                "payroll_period" => $payrollPeriod,
                "allowance_name" => $allowance->allowance_name,
                "allowance_price" => $allowance->allowance_period == "Monthly" ? $allowance->allowance_price / 2 : $allowance->allowance_price,
                "allowance_type" => $allowance->allowance_type
            ];
            $this->temp_allowance_records_employees[] = $temp_allowance_record_employee;
        }
    }

    function getDeductionRecordEmp($empId, $payrollPeriod) {
        foreach($this->selfDeduction as $deduction) {
            if($deduction != $empId) {
                continue;
            }
            $temp_deduction_record_employee = [
                "id" => $this->generateId->generate(DeductionRecordEmployee::class),
                "employee" => $empId,
                "payroll_period" => $payrollPeriod,
                "deduction_name" => $deduction->deduction_name,
                "deduction_price" => $deduction->deduction_period == "Monthly" ? $deduction->deduction_price / 2 : $deduction->deduction_price,
                "deduction_type" => $deduction->deduction_type
            ];
            $this->temp_deduction_records_employees[] = $temp_deduction_record_employee;
        }
    }
}