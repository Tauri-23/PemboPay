<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthenticateService;
use App\Contracts\IGenerateFilenameService;
use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveService;
use App\Contracts\ISaveAccountantLogsDBService;
use App\Models\AccountantLogs;
use App\Models\Barangays;
use App\Models\Cities;
use App\Models\Compensation;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\Holidays;
use App\Models\timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountantEmployeesController extends Controller
{
    protected $loggedService; //service to retrieve logged accountant data
    protected $retrieveDb; // service to retrieve all from specific table in database
    protected $generateId;
    protected $generateFilename;
    protected $saveLogDb;

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb, 
        IGenerateIdService $generateId, IGenerateFilenameService $generateFilename,
        ISaveAccountantLogsDBService $saveLogDb) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
        $this->generateId = $generateId;
        $this->generateFilename = $generateFilename;
        $this->saveLogDb = $saveLogDb;
    }


    //Redirect and setup the datas for the page
    public function employees() {

        return view('UserTreasury.Employees.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'employees' => Employees::with('department', 'department_positions')->get(),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function viewEmployee($id, $timeSheetMonth, $activePage) {
        $timesheets = timesheet::where('employee', $id)->get();
        $holidays = Holidays::all();

        if($timeSheetMonth == 'null') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }
        else {
            $startDate = Carbon::now()->month($timeSheetMonth)->startOfMonth();
            $endDate = Carbon::now()->month($timeSheetMonth)->endOfMonth();
        }
        
        $datesInRange = [];

        for($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $datesInRange[] = $date->copy();
        }

        return view('UserTreasury.Employees.viewEmployee', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get(),
            'employee' => Employees::find($id),
            'cities' => Cities::all(),
            'brgys' => Barangays::all(),
            'timesheetDates' => $timesheets,
            'datesInRange' => $datesInRange,
            'holidays' => $holidays,
            'activePage' => $activePage,
            'empId' => $id,
            'endDate' => $endDate
        ]);

    }



    public function editEmployee(Request $request) {
        $employee = Employees::where('id', $request->emp_id)->with('compensation')->first();
        if($request->editType == "Personal Information") {
            $employee->firstname = $request->fname;
            $employee->middlename = $request->mname;
            $employee->lastname = $request->lname;
            $employee->phone = $request->phone;
            $employee->gender = $request->gender;
        }
        else if($request->editType == "Address Information") {
            $employee->street_address = $request->street_address;
            $employee->city = $request->city;
            $employee->barangay = $request->brgy;
        }
        else if($request->editType == "Pay Information") {
            // if ($employee->compensation) {
            //     // Update compensation attributes if the relationship exists
            //     $employee->compensation->compentsation_type = $request->compensation_type;
            //     $employee->compensation->value = $request->price;
            //     $employee->compensation->save();
            // } else {
            //     // Create a new compensation record if it does not exist
            //     $compensation = new Compensation();
            //     $compensation->compentsation_type = $request->compensation_type;
            //     $compensation->value = $request->price;
            //     $employee->compensation()->save($compensation);
            // }
        }

        if($employee->save()) {
            // Add logs
            $this->saveLogDb->saveLog("Edited Employee's ".$request->editType.": ".$request->old_fullname);

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



    public function UploadPfpToStorage(Request $request) {

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

        try {
            $targetDirectory = 'assets/media/pfp';

            $newFilename = $this->generateFilename->generate($file, $targetDirectory);

            //upload the file to the public directory
            $file->move(public_path($targetDirectory), $newFilename);

            $filePath = '/' . $targetDirectory . '/' . $newFilename;

            // Return a success response
            return response()->json([
                'status' => 200, 
                'filePath' => $filePath,
                'filename' => $newFilename
            ]);

        } catch(\Exception $ex) {
            return response()->json([
                'status' => 500,
                'message' =>'Failed to upload file: ' . $ex->getMessage()
            ]);
        }
    }


    public function UploadpPfpToDb(Request $request) {
        $employee = Employees::find($request->id);

        if($employee == null) {
            return response()->json([
                'status' => 401,
                'message' => 'No Employee'
            ]);
        }

        $employee->pfp = $request->pfp;

        if($employee->save()) {
            // Add logs
            $this->saveLogDb->saveLog("Edited Employee's Profile Picture: ". $employee->firstname . " " . $employee->lastname);

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


    public function deleteEmpPost(Request $request) {
        $employee = Employees::find($request->empId);

        if(empty($employee)) {
            return response()->json([
                'status' => 401,
                'message' => 'no department'
            ]);
        }

        // Add logs
        $this->saveLogDb->saveLog("Deleted an Employee: ".$request->empName);

        $employee->delete();
        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
