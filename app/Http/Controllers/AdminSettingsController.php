<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Models\salary_grade;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\SettingsPayrollPeriod;
use App\Models\tax_exempt;
use App\Models\tax_exempt_values;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    protected $generateId;

    public function __construct(IGenerateIdService $generateId) {
        $this->generateId = $generateId;
    }

    public function index() {
        $salGrades = salary_grade::orderBy('value', 'ASC')->get();
        $taxExempts = tax_exempt::all();
        $allowances = settings_allowance::all();
        $deductions = SettingsDeductions::all();
        $payrollPeriod = SettingsPayrollPeriod::find('493134');

        return view('UserAdmin.Settings.index', [
            'salGrades' => $salGrades,
            'taxExempts' => $taxExempts,
            'allowances' => $allowances,
            'deductions' => $deductions,
            'payrollPeriod' => $payrollPeriod
        ]);
    }

    public function taxExemptTable($id) {
        $taxExemptRows = tax_exempt_values::where('tax_exempt', $id)->get();
        $taxExempt = tax_exempt::find($id);

        return view('UserAdmin.Settings.taxExemptTable', [
            'taxExemptRows' => $taxExemptRows,
            'taxExempt' => $taxExempt
        ]);
    }


    public function addSalGradePost(Request $request) {
        $isSalGradeNameExist = salary_grade::where('grade', $request->grade)->first();

        if($isSalGradeNameExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Grade already exist.'
            ]);
        }

        $salGrade = new salary_grade;
        $salGrade->grade = $request->grade;
        $salGrade->value = $request->value;

        if($salGrade->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function editSalGradePost(Request $request) {
        $salGrade = salary_grade::find($request->id);
        $salGrade->grade = $request->grade;
        $salGrade->value = $request->value;

        if($salGrade->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function deleteSalGradePost(Request $request) {
        $salGrade = salary_grade::find($request->id);

        if($salGrade->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }



    public function addTaxExemptPost(Request $request) {
        $taxExempt = new tax_exempt;

        $taxExempt->name = $request->name;
        $taxExempt->period_of_deduction = $request->period;
        

        if($taxExempt->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => 'Something went wrong please try again later.'
            ]);
        }

    }

    public function delTaxExemptPost(Request $request) {
        $taxExempt = tax_exempt::find($request->id);

        if($taxExempt->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function addTaxExemptRowPost(Request $request) {
        $isRangeExist = tax_exempt_values::where('threshold_min', $request->thresholdMin)->where('threshold_max', $request->thresholdMax)->first();

        if($isRangeExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Threshold range already exist.'
            ]);
        }

        $taxExempt = new tax_exempt_values;
        $taxExempt->tax_exempt = $request->taxId;
        $taxExempt->price_percent = $request->valuePercent;
        $taxExempt->price_amount = $request->valueAmt;
        $taxExempt->threshold_min = $request->thresholdMin;
        $taxExempt->threshold_max = $request->thresholdMax;

        if($taxExempt->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function delTaxExemptRowPost(Request $request) {
        $taxTable = tax_exempt::find($request->taxId);

        if(!$taxTable) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Tax Table please try again later.'
            ]);
        }

        $taxCol = tax_exempt_values::find($request->taxColId);

        if($taxCol->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function editTaxExemptRowPost(Request $request) {
        $isRangeExist = tax_exempt_values::where('threshold_min', $request->thresholdMin)->where('threshold_max', $request->thresholdMax)->first();

        if($isRangeExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Threshold range already exist.'
            ]);
        }

        $taxExempt = tax_exempt_values::find($request->taxColId);
        $taxExempt->price_percent = $request->valuePercent;
        $taxExempt->price_amount = $request->valueAmt;
        $taxExempt->threshold_min = $request->thresholdMin;
        $taxExempt->threshold_max = $request->thresholdMax;

        if($taxExempt->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function AddAllowancePost(Request $request) {
        return $this->AddToDb($request, new settings_allowance());
    }
    public function DelAllowancenPost(Request $request) {
        return $this->DelToDb($request, new settings_allowance);
    }

    public function AddDeductionsPost(Request $request) {
        return $this->AddToDb($request, new SettingsDeductions);
    }
    public function DelDeductionPost(Request $request) {
        return $this->DelToDb($request, new SettingsDeductions);
    }





    public function AddToDb(Request $request, Model $model) {
        $model->id = $this->generateId->generate($model);
        $model->name = $request->name;
        $model->price = $request->price;
        $model->type = $request->type;
        $model->period = $request->period;

        if($model->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status' => 401,
                'message' => 'error'
            ]);
        }
    }
    public function DelToDb(Request $request, Model $model) {
        $record = $model::find($request->id);

        if($record->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status' => 401,
                'message' => 'error'
            ]);
        }
    }
}
