<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Models\AccountantLogs;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\taxes;
use App\Models\TaxValues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AccountantPaySettingsController extends Controller
{
    protected $loggedService;
    protected $generateId;

    public function __construct(ILoggedService $loggedService, IGenerateIdService $generateId) {
        $this->loggedService = $loggedService;
        $this->generateId = $generateId;
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
            // Add logs
            $log = new AccountantLogs;
            $log->id = $this->generateId->generate(AccountantLogs::class);
            $log->accountant = session('logged_treasury');
            $log->title = "Add a tax column in ".$taxTable->name." table.";
            $log->save();

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

    public function AddAllowancePost(Request $request) {
        return $this->AddToDb($request, new settings_allowance);
    }

    public function AddDeductionsPost(Request $request) {
        return $this->AddToDb($request, new SettingsDeductions);
    }

    public function DelTaxPost(Request $request) {
        return $this->DelToDb($request, new taxes);
    }

    public function DelAllowancenPost(Request $request) {
        return $this->DelToDb($request, new settings_allowance);
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
