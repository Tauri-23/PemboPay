<?php

namespace App\Http\Controllers;

use App\Contracts\IComputePayrollService;
use App\Models\AllowanceRecord;
use App\Models\AllowanceRecordEmployee;
use App\Models\DeductionRecord;
use App\Models\DeductionRecordEmployee;
use App\Models\PayrollRecord;
use App\Models\PayrollRecordSummary;
use App\Models\tax_record_employees;
use App\Models\taxes_record;
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
        $tempAllowanceRecords = json_decode($request->input('temp_allowance_records'), true);
        $tempAllowanceRecordsEmployees = json_decode($request->input('temp_allowance_records_employees'), true);
        $tempDeductionRecords = json_decode($request->input('temp_deduction_records'), true);
        $tempDeductionRecordsEmployees = json_decode($request->input('temp_deduction_records_employees'), true);
        $tempTaxesRecordEmployees = json_decode($request->input('temp_taxes_record_employees'), true);

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

        foreach($tempAllowanceRecords as $allowanceRecord) {
            $allowanceRecords = new AllowanceRecord;
            $allowanceRecords->id = $allowanceRecord['id'];
            $allowanceRecords->payroll_period = $allowanceRecord['payroll_period'];
            $allowanceRecords->allowance_name = $allowanceRecord['allowance_name'];
            $allowanceRecords->allowance_price = $allowanceRecord['allowance_price'];
            $allowanceRecords->allowance_type = $allowanceRecord['allowance_type'];
            
            $allowanceRecords->save();
        }

        foreach($tempAllowanceRecordsEmployees as $allowanceRecordEmp) {
            $allowanceRecordsEmp = new AllowanceRecordEmployee;
            $allowanceRecordsEmp->id = $allowanceRecordEmp['id'];
            $allowanceRecordsEmp->employee = $allowanceRecordEmp['employee'];
            $allowanceRecordsEmp->payroll_period = $allowanceRecordEmp['payroll_period'];
            $allowanceRecordsEmp->allowance_name = $allowanceRecordEmp['allowance_name'];
            $allowanceRecordsEmp->allowance_price = $allowanceRecordEmp['allowance_price'];
            $allowanceRecordsEmp->allowance_type = $allowanceRecordEmp['allowance_type'];
            
            $allowanceRecordsEmp->save();
        }

        foreach($tempDeductionRecords as $deductionRecord) {
            $deductionRecords = new DeductionRecord;
            $deductionRecords->id = $deductionRecord['id'];
            $deductionRecords->payroll_period = $deductionRecord['payroll_period'];
            $deductionRecords->deduction_name = $deductionRecord['deduction_name'];
            $deductionRecords->deduction_price = $deductionRecord['deduction_price'];
            $deductionRecords->deduction_type = $deductionRecord['deduction_type'];
            
            $deductionRecords->save();
        }

        foreach($tempDeductionRecordsEmployees as $deductionRecordEmp) {
            $deductionRecordsEmp = new DeductionRecordEmployee;
            $deductionRecordsEmp->id = $deductionRecordEmp['id'];
            $deductionRecordsEmp->employee = $deductionRecordEmp['employee'];
            $deductionRecordsEmp->payroll_period = $deductionRecordEmp['payroll_period'];
            $deductionRecordsEmp->deduction_name = $deductionRecordEmp['deduction_name'];
            $deductionRecordsEmp->deduction_price = $deductionRecordEmp['deduction_price'];
            $deductionRecordsEmp->deduction_type = $deductionRecordEmp['deduction_type'];
            
            $deductionRecordsEmp->save();
        }

        foreach($tempTaxesRecordEmployees as $taxRecord) {
            $taxRecords = new tax_record_employees;
            $taxRecords->id = $taxRecord['id'];
            $taxRecords->employee = $taxRecord['employee'];
            $taxRecords->payroll_period = $taxRecord['payroll_period'];
            $taxRecords->tax_name = $taxRecord['tax_name'];
            $taxRecords->tax_price = $taxRecord['tax_price'];
            
            $taxRecords->save();
        }
        
        
        return response()->json([
            "status" => 200
        ]);
    }
}
