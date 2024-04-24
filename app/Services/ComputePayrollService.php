<?php
namespace App\Services;

use App\Contracts\IComputePayrollService;
use App\Models\Employees;
use App\Models\PayrollRecordSummary;
use App\Models\SettingsPayrollPeriod;
use App\Models\timesheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ComputePayrollService implements IComputePayrollService {

    //
    private $employees;
    private $timesheet;
    private $settingsPayrollPeriod;

    private $payrollRecordSummaries;

    public function process($month, $period, $year) {
        //Payroll Settings Configurations
        $this->settingsPayrollPeriod = SettingsPayrollPeriod::first();

        $monthYear = Carbon::createFromDate($year, $month, 1);

        $payrollPeriod = $year."-".$period."-".$month;

        //Start and End Date of Payroll Based on the Cutoff
        $computedPayrollPeriod = $this->ComputePayrollPeriod($month, $period, $year);

        //payroll summaries from database
        $this->payrollRecordSummaries = PayrollRecordSummary::where("payroll_period", $payrollPeriod)->first();


        //Check if payroll existing Yes?Return and not continue
        if($this->payrollRecordSummaries != null) {
            return response()->json([
                "status" => 401,
                "message" => "There is already a record for the Period of {$payrollPeriod}"]
            );
        }

        $this->ProcessPayroll($computedPayrollPeriod, $year);
    }





    // This Function is responsible fo computing the Start Date and End Date
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

    //Process the payroll
    function ProcessPayroll($computedPayrollPeriod, $year) {

        $startDate = Carbon::parse($computedPayrollPeriod['startDate']);
        $endDate = Carbon::parse($computedPayrollPeriod['endDate']);

        $this->employees = Employees::all();

        //get the timesheet that meet the payroll period
        $this->timesheet = timesheet::where(function($query) use ($startDate) {
            $query->where(DB::raw('DATE(time_in)'), '>=', $startDate->toDateString());
        })
        ->where(function ($query) use ($endDate) {
            $query->where(DB::raw('DATE(time_in)'), '<=', $endDate->toDateString());
        })
        ->whereYear('time_in', $year)
        ->get();

        foreach($this->employees as $emp) {
            $hoursWorked = $this->GetHoursWorked($emp->id);
            $basicPay = $emp->compensation()->first()->compentsation_type == "salary" ? $emp->compensation()->first()->value / 2 : $emp->compensation()->first()->value * $hoursWorked;
            


            echo 'asdasd';
        }
        
    }
    




    //Compute the Total Hours of the selected user 
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




}