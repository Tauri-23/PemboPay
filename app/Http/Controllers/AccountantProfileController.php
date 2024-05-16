<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateFilenameService;
use App\Models\AccountantLogs;
use App\Models\Treasuries;
use App\Services\GenerateIdService;
use Illuminate\Http\Request;

class AccountantProfileController extends Controller
{
    protected $generateFilename;
    protected $generateId;

    public function __construct(IGenerateFilenameService $generateFilename, GenerateIdService $generateId) {
        $this->generateFilename = $generateFilename;
        $this->generateId = $generateId;
    }

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

        if($request->editType == "Personal Information") { //Change Personal Information
            $accountant->Firstname = $request->fname;
            $accountant->Middlename = $request->mname;
            $accountant->Lastname = $request->lname;
        }
        else if($request->editType == "Password") { //Change Password
            $accountant->password = $request->password;
        }
        else if($request->editType == "PFP") { //Change PFP
            if(!$request->hasFile('file')) {
                return response()->json([
                    'status' => 401,
                    'message' => 'No file uploaded'
                ]);
            }
    
            $file = $request->file('file');
    
            if(!$file->isValid()) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid file'
                ]);
            }
    
            try { // Upload file to Storaga
                $targetDirectory = 'assets/media/pfp';
    
                $newFilename = $this->generateFilename->generate($file, $targetDirectory);
    
                //upload the file to the public directory
                $file->move(public_path($targetDirectory), $newFilename);

                $accountant->pfp = $newFilename; //Update pfp to database
    
            } catch(\Exception $ex) {
                return response()->json([
                    'status' => 500,
                    'message' =>'Failed to upload file: ' . $ex->getMessage()
                ]);
            }
        }

        // If success Save
        if($accountant->save()) {
            // Add logs
            $log = new AccountantLogs;
            $log->id = $this->generateId->generate(AccountantLogs::class);
            $log->accountant = session('logged_treasury');
            $log->title = "Updated ". ($accountant->gender == "Male" ? "his" : "her") ." profile";
            $log->save();

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
