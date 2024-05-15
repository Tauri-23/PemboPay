<?php

namespace App\Http\Controllers;

use App\Models\AccountantLogs;
use App\Models\Treasuries;
use Illuminate\Http\Request;

class AccountantProfileController extends Controller
{
    public function index($id) {
        $accountant = Treasuries::find($id);

        return view('UserTreasury.Profile.index', [
            'accountant' => $accountant,
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get(),
            "selfLogs" => AccountantLogs::where('accountant', $id)->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    public function editProfilePost(Request $request) {
        $accountant = Treasuries::find($request->accId);

        if($request->editType == "Personal Information") {
            $accountant->Firstname = $request->fname;
            $accountant->Middlename = $request->mname;
            $accountant->Lastname = $request->lname;
        }


        if($accountant->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'error'
            ]);
        }
    }
}
