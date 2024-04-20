<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Models\settings_allowance;
use App\Models\SettingsDeductions;
use App\Models\taxes;
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
            'deductions' => SettingsDeductions::all()
        ]);
    }

    public function AddTaxPost(Request $request) {
        return $this->AddToDb($request, new taxes);
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
