<?php
namespace App\Services;

use App\Contracts\IComputePayrollService;
use App\Contracts\IGenerateIdService;
use App\Models\AllowanceRecord;
use App\Models\AllowanceRecordEmployee;
use App\Models\DeductionRecord;
use App\Models\DeductionRecordEmployee;
use App\Models\employee_absent_deduction_records;
use App\Models\employee_allowance;
use App\Models\employee_deductions;
use App\Models\Employees;
use App\Models\Holidays;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\SettingsPayrollPeriod;
use App\Models\tax_exempt;
use App\Models\tax_exempt_values;
use App\Models\tax_record_employees;
use App\Models\taxes;
use App\Models\taxes_record;
use App\Models\TaxValues;
use App\Models\timesheet;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class ComputePayrollService implements IComputePayrollService {

    //Services
    protected $generateId;

    //
    private $monthPeriod;

    private $holidays;
    private $employees;
    private $timesheet;
    private $settingsPayrollPeriod;
    private $generalAllowance;
    private $selfAllowance;
    private $generalDeduction;
    private $selfDeduction;
    private $generalTaxes;
    private $generalTaxExempt;

    private $payrollRecordSummaries;


    private $temp_payroll_records = [];
    private $temp_payroll_record_summaries = [];
    private $temp_allowance_records = [];
    private $temp_allowance_records_employees = [];
    private $temp_deduction_records = [];
    private $temp_deduction_records_employees = [];
    private $temp_taxes_record_employees = [];
    private $temp_employee_absent_deduction_records = [];

    public function __construct(IGenerateIdService $generateId) {
        $this->generateId = $generateId;
    }

    public function process($month, $period, $year) {

        $this->settingsPayrollPeriod = SettingsPayrollPeriod::first(); //Payroll Settings Configurations

        $this->monthPeriod = $period;

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
            "temp_taxes_record_employees" => $this->temp_taxes_record_employees,
            "temp_employee_absent_deduction_records" => $this->temp_employee_absent_deduction_records,
            "period" => $payrollPeriod
        ]);
    }





    function ComputePayrollPeriod($month, $period, $year) {
        // Fetch holidays for the given month and year
        $holidays = Holidays::whereMonth('holiday_date', $month)
                            ->whereYear('holiday_date', $year)
                            ->pluck('holiday_date')
                            ->toArray();
    
        $startDate = null;
        $endDate = null;
    
        if ($period == "1-15") {
            $startDate = Carbon::create($year, $month, 1)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
    
            // If the start date is a weekend, adjust to next Monday
            if ($startDate->isWeekend()) {
                $startDate->next(Carbon::MONDAY);
            }
    
            // Adjust start date to the nearest Sunday before the 1st if necessary
            while ($startDate->day > 1 && $startDate->dayOfWeek === Carbon::SUNDAY) {
                $startDate->subDay();
            }
    
            // Calculate end date for period "1-15"
            $endDate = Carbon::create($year, $month, 15)
                ->addDay()
                ->subSeconds(1) // Subtract one second to get the last second of the 15th
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
    
            // Adjust end date to the nearest Sunday before the 15th if necessary
            while ($endDate->day > 1 && $endDate->dayOfWeek === Carbon::SUNDAY) {
                $endDate->subDay();
            }
        } elseif ($period == "16-30") {
            $startDate = Carbon::create($year, $month, 16)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
    
            // If the start date is a weekend, adjust to next Monday
            if ($startDate->isWeekend()) {
                $startDate->next(Carbon::MONDAY);
            }
    
            // Adjust start date to the nearest Sunday before the 16th if necessary
            while ($startDate->day > 1 && $startDate->dayOfWeek === Carbon::SUNDAY) {
                $startDate->subDay();
            }
    
            // Calculate end date for period "16-30"
            $endDate = Carbon::create($year, $month, Carbon::createFromDate($year, $month)->daysInMonth)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
    
            // Adjust end date to the nearest Sunday before the last day of the month if necessary
            while ($endDate->day > 1 && $endDate->dayOfWeek === Carbon::SUNDAY) {
                $endDate->subDay();
            }
        } elseif ($period == "1-30") {
            $startDate = Carbon::create($year, $month, 1)
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
    
            // If the start date is a weekend, adjust to next Monday
            if ($startDate->isWeekend()) {
                $startDate->next(Carbon::MONDAY);
            }
    
            // Adjust start date to the nearest Sunday before the 1st if necessary
            while ($startDate->day > 1 && $startDate->dayOfWeek === Carbon::SUNDAY) {
                $startDate->subDay();
            }
    
            // Calculate end date for period "1-30"
            $endDate = Carbon::create($year, $month, Carbon::createFromDate($year, $month)->daysInMonth)
                ->addDay()
                ->subSeconds(1) // Subtract one second to get the last second of the last day
                ->subDays($this->settingsPayrollPeriod->payroll_cutoff);
    
            // Adjust end date to the nearest Sunday before the last day of the month if necessary
            while ($endDate->day > 1 && $endDate->dayOfWeek === Carbon::SUNDAY) {
                $endDate->subDay();
            }
        }
    
        // Adjust start date if it falls on a holiday that is a weekday
        if (!$startDate->isWeekend()) {
            while (in_array($startDate->toDateString(), $holidays) && !$startDate->isWeekend()) {
                $startDate->subDay();
                // Ensure the new start date is not a Sunday
                while ($startDate->dayOfWeek === Carbon::SUNDAY) {
                    $startDate->subDay();
                }
            }
        }
    
        // Adjust end date if it falls on a holiday that is a weekday
        while (in_array($endDate->toDateString(), $holidays) && !$endDate->isWeekend()) {
            $endDate->subDay();
            // Ensure the new end date is not a Sunday
            while ($endDate->dayOfWeek === Carbon::SUNDAY) {
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
        $this->holidays = Holidays::where(function ($query) use ($startDate) {
            $query->where(DB::raw('DATE(holiday_date)'), '>=', $startDate->toDateString());
        })
        ->where(function ($query) use ($endDate) {
            $query->where(DB::raw('DATE(holiday_date)'), '<=', $endDate->toDateString());
        })
        ->whereYear('holiday_date', $year)
        ->whereRaw('DAYOFWEEK(holiday_date) NOT IN (1, 7)') // Exclude Saturdays and Sundays
        ->get();// get the Holidays that meet the payroll period
        
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
        $this->generalTaxExempt = tax_exempt::where('period_of_deduction', $this->monthPeriod == '1-15' ? 'Every 15': 'Every End of the month')->get(); //Get Tax exempt

        $totalHoursWorkedSummary = 0.0;
        $totalDeductionsSummary = 0.0;
        $totalAllowanceSummary = 0.0;
        $totalBasicPaySummary = 0.0;
        $totalGrossPaySummary = 0.0; 
        $totalNetPaySummary = 0.0;

        



        foreach($this->employees as $emp) { //Employee Iteration compute per employee

            $salaryGrade = $emp->department_positions()->first()->salary_grades()->first()->value / 2; //Salary Grade from database
            $hoursWorked = $this->GetHoursWorked($emp->id);
            $daysWorked = $hoursWorked / 8;

            $holidayCount = $this->holidays->count();

            // Number of working days base on the payroll period 
            // $workDaysNum = $startDate->diffInDaysFiltered(function (Carbon $date) {
            //     return $date->isWeekday();
            // }, $endDate);

            $workDaysNum = 0;
            $currentDate = $startDate->copy();

            while ($currentDate <= $endDate) {
                if ($currentDate->isWeekday()) {
                    $workDaysNum++;
                }
                $currentDate->addDay(); // Move to the next day
            }

            $workDaysNum - $holidayCount;

            $daysAbsent = $workDaysNum - $daysWorked; // Number of Days Absent  
            
            $dayRate = $salaryGrade / $workDaysNum;

            $absentDeduction = $dayRate * $daysAbsent;

            
            

            // $absentDeduction = ;
            $basicPay = $salaryGrade;

            $genAllowance = $this->GetGeneralAllowance($basicPay);
            $selfAllowance = $this->GetSelfAllowance($emp->id, $basicPay);
            $totalAllowance = $genAllowance + $selfAllowance;

            $genDeductions = $this->GetGeneralDeductions($basicPay);
            $selfDeductions = $this->GetSelfDeductions($emp->id, $basicPay);

            // Taxes
            $genTax = $this->GetGeneralTax($basicPay);
            $genTaxExempt = $this->GetGeneralTaxExempt($basicPay);

            $totalDeductions = $genDeductions + $selfDeductions + $genTax + $genTaxExempt + $absentDeduction;

            $grossPay = $basicPay + $totalAllowance;
            $netPay = number_format($grossPay - $totalDeductions, 2, '.', '');


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
                "position" => $emp->department_positions()->first()->position,
                "total_absent" => $daysAbsent,
                "hours_worked" => $hoursWorked,
                "deductions" => $totalDeductions,
                "allowance" => $totalAllowance,
                "gross_pay" => $grossPay,
                "net_pay" => $netPay,
                "basic_pay" => $basicPay
            ];

            $temp_employee_absent_deduction_record = [
                "id" => $this->generateId->generate(employee_absent_deduction_records::class),
                "payroll_period" => $payrollPeriod,
                "employee" => $emp->id,
                "days_absent" => $daysAbsent,
                "deductions" => $absentDeduction
            ];



            // TODO::
            //All Tax Record Per Employee
            foreach($this->generalTaxes as $tax) {
                $totalTax = 0.0;

                $taxTable = TaxValues::where('tax', $tax->id)->get();

                $excessTaxable = 0;
                foreach($taxTable as $taxTbl) {
                    
                    if($basicPay > $taxTbl->threshold_min && $basicPay < $taxTbl->threshold_max) {
                        $excessTaxable = $basicPay - $taxTbl->threshold_min;
                        $totalTax += ($excessTaxable * ($taxTbl->price_percent / 100)) - $taxTbl->price_amount;
                    }
                }

                $temp_tax_record_employee = [
                    "id" => $this->generateId->generate(tax_record_employees::class),
                    "employee" => $emp->id,
                    "payroll_period" => $payrollPeriod,
                    "tax_name" => $tax->name,
                    "tax_price" => $totalTax,
                ];

                $this->temp_taxes_record_employees[] = $temp_tax_record_employee;
            }

            // For TaxExempt
            foreach($this->generalTaxExempt as $tax) {
                $totalTax = 0.0;

                $taxTable = tax_exempt_values::where('tax_exempt', $tax->id)->get();

                foreach($taxTable as $taxTbl) {
                    
                    if($basicPay > $taxTbl->threshold_min && $basicPay < $taxTbl->threshold_max) {
                        $totalTax += ($basicPay * ($taxTbl->price_percent /100)) + $taxTbl->price_amount;
                    }
                }

                $temp_tax_record_employee = [
                    "id" => $this->generateId->generate(tax_record_employees::class),
                    "employee" => $emp->id,
                    "payroll_period" => $payrollPeriod,
                    "tax_name" => $tax->name,
                    "tax_price" => $totalTax,
                ];

                $this->temp_taxes_record_employees[] = $temp_tax_record_employee;
            }

            
            $this->getAllowanceRecordEmp($emp->id, $payrollPeriod); //Allowance Record specific employee
            $this->getDeductionRecordEmp($emp->id, $payrollPeriod); //Deduction Record specific employee
            $this->temp_payroll_records[] = $temp_payroll_record; //Payroll Record specific employee
            $this->temp_employee_absent_deduction_records[] = $temp_employee_absent_deduction_record; //Absent Record for Archive Purposes
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





    /*
    |----------------------------------------
    | Taxes and Contributions
    |----------------------------------------
    */
    function GetGeneralTax($basicPay) { //Get General Tax From DB
        $totalTax = 0.0;

        if($this->generalTaxes == null) {
            return $totalTax;
        }

        foreach($this->generalTaxes as $taxes) {
            $taxTable = TaxValues::where('tax', $taxes->id)->get();

            $excessTaxable = 0;
            foreach($taxTable as $taxTbl) {
                
                if($basicPay > $taxTbl->threshold_min && $basicPay < $taxTbl->threshold_max) {
                    $excessTaxable = $basicPay - $taxTbl->threshold_min;
                    $totalTax += ($excessTaxable * ($taxTbl->price_percent / 100)) - $taxTbl->price_amount;
                }
            }

        }

        return $totalTax;
    }

    function GetGeneralTaxExempt($basicPay) { //Get General Tax From DB
        $totalTax = 0.0;

        if($this->generalTaxExempt == null) {
            return $totalTax;
        }

        foreach($this->generalTaxExempt as $taxes) {
            $taxTable = tax_exempt_values::where('tax_exempt', $taxes->id)->get();

            foreach($taxTable as $taxTbl) {
                
                if($basicPay > $taxTbl->threshold_min && $basicPay < $taxTbl->threshold_max) {
                    $totalTax += ($basicPay * ($taxTbl->price_percent /100)) + $taxTbl->price_amount;
                }
            }

        }

        return $totalTax;
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