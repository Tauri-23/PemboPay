<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ISendEmailService;
use App\Mail\AddAccountantCredentials;
use App\Models\AccountantLogs;
use App\Models\Treasuries;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDashController extends Controller
{
    protected $generateId;
    protected $sendEmail;

    public function __construct(IGenerateIdService $generateId, ISendEmailService $sendEmail) {
        $this->generateId = $generateId;
        $this->sendEmail = $sendEmail;
    }

    public function index() {
        $accountants = Treasuries::all();
        $logs = AccountantLogs::orderBy('created_at', 'DESC')->take(10)->get();
        return view('UserAdmin.index', [
            'accountants' => $accountants,
            'logs' => $logs
        ]);
    }


    public function AccountantIndex() {
        $accountants = Treasuries::all();
        return view('UserAdmin.Accountants.index', [
            'accountants' => $accountants,
        ]);
    }

    public function AccountantView($id) {
        $accountant = Treasuries::find($id);
        $logs = AccountantLogs::where('accountant', $id)->orderBy('created_at', 'DESC')->take(5)->get();

        return view('UserAdmin.Accountants.view', [
            'accountant' => $accountant,
            'logs' => $logs
        ]);
    }

    public function AddAccountantPost(Request $request) {
        $isEmailExist = Treasuries::where('email', $request->email)->first();
        $isUnameExist = Treasuries::where('username', $request->uname)->first();
        
        if($isUnameExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Username already exist.'
            ]);
        }

        if($isEmailExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Email already exist.'
            ]);
        }

        

        $password = Str::random(8);

        $accountant = new Treasuries;
        $accountant->id = $this->generateId->generate(Treasuries::class);
        $accountant->Firstname = $request->fname;
        $accountant->Middlename = $request->mname;
        $accountant->Lastname = $request->lname;

        $accountant->username = $request->uname;
        $accountant->gender = $request->gender;
        $accountant->email = $request->email;
        $accountant->phone = $request->phone;
        $accountant->pfp = 'defaultPFP.png';

        $accountant->password = $password;

        $accountant->status = 'ACTIVE';

        $this->sendEmail->send(new AddAccountantCredentials($request->uname, $password), $request->email);

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

    public function DelAccountant(Request $request) {
        $accountant = Treasuries::find($request->accId);

        if($accountant->delete()) {
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


    public function AccountantLogs() {
        $logs = AccountantLogs::orderBy('created_at', 'DESC')->get();

        return view('UserAdmin.AccountantLogs.index', [
            'logs' => $logs
        ]);
    }
}
