<?php

namespace App\Http\Controllers;

use App\Contracts\IComputePayrollService;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
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


    public function addPayrollToDb(Request $request) {
        $tempPayrollRecords = json_decode($request->input('temp_payroll_records'), true);
        $tempPayrollRecordSummaries = json_decode($request->input('temp_payroll_record_summaries'), true);

        foreach($tempPayrollRecords as $tempPayroll) {
            $payrollRecords = new PayrollRecord;
            $payrollRecords->id = $tempPayroll['id'];
            $payrollRecords->payroll_period = $tempPayroll['payroll_period'];
            $payrollRecords->employee = $tempPayroll['employee'];
            $payrollRecords->hours_worked = $tempPayroll['hours_worked'];
            $payrollRecords->deductions = $tempPayroll['deductions'];
            $payrollRecords->allowance = $tempPayroll['allowance'];
            $payrollRecords->gross_pay = $tempPayroll['gross_pay'];
            $payrollRecords->net_pay = $tempPayroll['net_pay'];
            $payrollRecords->basic_pay = $tempPayroll['basic_pay'];

            $payrollRecords->save();
        }

        foreach($tempPayrollRecordSummaries as $empPaySummaries) {
            $payrollRecordSummaries = new PayrollRecordSummary;
            $payrollRecordSummaries->id = $empPaySummaries['id'];
            $payrollRecordSummaries->payroll_period = $empPaySummaries['payroll_period'];
            $payrollRecordSummaries->total_hours_worked = $empPaySummaries['total_hours_worked'];
            $payrollRecordSummaries->total_deduction = $empPaySummaries['total_deductions'];
            $payrollRecordSummaries->total_allowance = $empPaySummaries['total_allowance'];
            $payrollRecordSummaries->total_basic_pay = $empPaySummaries['total_basic_pay'];
            $payrollRecordSummaries->total_gross_pay = $empPaySummaries['total_gross_pay'];
            $payrollRecordSummaries->total_net_pay = $empPaySummaries['total_net_pay'];
            
            $payrollRecordSummaries->save();
        }
        
        
        return response()->json([
            "status" => 200
        ]);
    }
}
