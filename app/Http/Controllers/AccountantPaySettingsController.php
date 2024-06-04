<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\ISaveAccountantLogsDBService;
use App\Models\AccountantLogs;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\tax_exempt;
use App\Models\tax_exempt_values;
use App\Models\taxes;
use App\Models\TaxValues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AccountantPaySettingsController extends Controller
{
    protected $loggedService;
    protected $generateId;
    protected $saveLogDb;

    public function __construct(ILoggedService $loggedService, IGenerateIdService $generateId, ISaveAccountantLogsDBService $saveLogDb) {
        $this->loggedService = $loggedService;
        $this->generateId = $generateId;
        $this->saveLogDb = $saveLogDb;
    }


    public function payrollSettings() {
        return view('UserTreasury.PayrollSettings.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'taxes' => taxes::all(),
            'allowances' => settings_allowance::all(),
            'deductions' => SettingsDeductions::all(),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function viewTaxTable($id) {
        $tax = taxes::find($id);
        $taxCol = TaxValues::orderBy('threshold_min', 'ASC')->where('tax', $id)->get();


        return view('UserTreasury.PayrollSettings.taxTable', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'tax' => $tax,
            'taxCol' => $taxCol,
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function AddTaxPost(Request $request) {
        $taxes = new taxes;
        $taxes->id = $this->generateId->generate(taxes::class);
        $taxes->name = $request->name;
        $taxes->period = $request->period;

        if($taxes->save()) {
            $this->saveLogDb->saveLog("Add a tax table".$request->name." table."); // Add logs to db
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

    public function addTaxColumnPost(Request $request) {
        $taxTable = taxes::find($request->taxId);

        if(!$taxTable) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Tax Table please try again later.'
            ]);
        }

        $taxCol = new TaxValues;
        $taxCol->id = $this->generateId->generate(TaxValues::class);
        $taxCol->tax = $request->taxId;
        $taxCol->price_percent = $request->valuePercent;
        $taxCol->price_amount = $request->valueAmt;
        $taxCol->threshold_min = $request->thresholdMin;
        $taxCol->threshold_max = $request->thresholdMax;

        if($taxCol->save()) {
            $this->saveLogDb->saveLog("Add a tax column in ".$taxTable->name." table."); // Add logs to db

            return response()->json([
                'status' => 200,
                'message' => 'New tax column has been added.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed adding tax column please try again later.'
            ]);
        }
    }


    public function editTaxColumnPost(Request $request) {
        $taxTable = taxes::find($request->taxId);

        if(!$taxTable) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Tax Table please try again later.'
            ]);
        }

        $taxCol = TaxValues::find($request->taxColId);
        $taxCol->price_percent = $request->valuePercent;
        $taxCol->price_amount = $request->valueAmt;
        $taxCol->threshold_min = $request->thresholdMin;
        $taxCol->threshold_max = $request->thresholdMax;

        if($taxCol->save()) {
            // Add logs
            $this->saveLogDb->saveLog("Edited a tax column in ".$taxTable->name." table."); // Add logs to db

            return response()->json([
                'status' => 200,
                'message' => 'Tax column has been successfully edited.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed editing tax column please try again later.'
            ]);
        }
    }

    public function delTaxColumnPost(Request $request) {
        $taxTable = tax_exempt::find($request->taxId);

        if(!$taxTable) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Tax Table please try again later.'
            ]);
        }

        $taxCol = tax_exempt_values::find($request->taxColId);

        if($taxCol->delete()) {
            // Add logs
            $this->saveLogDb->saveLog("Deleted a tax column in ".$taxTable->name." table."); // Add logs to db

            return response()->json([
                'status' => 200,
                'message' => 'Tax column has been successfully edited.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Failed editing tax column please try again later.'
            ]);
        }
    }






    public function AddAllowancePost(Request $request) {
        $this->saveLogDb->saveLog("Added an Allowance ". $request->name); // Add logs to db
        return $this->AddToDb($request, new settings_allowance);
        
    }

    public function AddDeductionsPost(Request $request) {
        $this->saveLogDb->saveLog("Added a Deduction ". $request->name); // Add logs to db
        return $this->AddToDb($request, new SettingsDeductions);
    }

    public function DelTaxPost(Request $request) {
        $this->saveLogDb->saveLog("Removed a tax table".$request->id); // Add logs to db
        return $this->DelToDb($request, new taxes);
    }

    public function DelAllowancenPost(Request $request) {
        $this->saveLogDb->saveLog("Removed an Allowance ". $request->id); // Add logs to db
        return $this->DelToDb($request, new settings_allowance);
    }

    public function DelDeductionPost(Request $request) {
        $this->saveLogDb->saveLog("Removed a Deduction ". $request->id); // Add logs to db
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
