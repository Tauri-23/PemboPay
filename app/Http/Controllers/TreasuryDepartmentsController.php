<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveIdService;
use App\Contracts\IRetrieveService;
use App\Contracts\IRetrieveWhereService;
use App\Contracts\ISaveAccountantLogsDBService;
use App\Models\AccountantLogs;
use App\Models\Departments;
use App\Models\Employees;
use Illuminate\Http\Request;

class TreasuryDepartmentsController extends Controller
{
    protected $loggedService;
    protected $retrieveDb; //retriever all elements of table
    protected $retrieveIdDb; //retriever specific elements of table via Id
    protected $retrieveWhereDb; //retriever using WHERE
    protected $generateId;

    protected $saveLogDb;

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb, 
    IRetrieveIdService $retrieveIdDb, IRetrieveWhereService $retrieveWhereDb, 
    IGenerateIdService $generateId, ISaveAccountantLogsDBService $saveLogDb) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
        $this->retrieveIdDb = $retrieveIdDb;
        $this->retrieveWhereDb = $retrieveWhereDb;
        $this->generateId = $generateId;
        $this->saveLogDb = $saveLogDb;
    }

    public function departments() {
        return view('UserTreasury.Departments.index', 
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
        'departments' => Departments::class::all(),
        "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }
    

    public function addDepartments() {
        return view('UserTreasury.Departments.addDepartment', 
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
        "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }


    public function viewDepartment($id) {
        return view('UserTreasury.Departments.viewDepartment',
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
        'department' => $this->retrieveIdDb->retrieveId(Departments::class, $id),
        'employees' => Employees::where('department', $id)->get(),
        "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }


    public function editDepartment($id) {
        return view('UserTreasury.Departments.editDepartment', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'department' => Departments::find($id),
            "logs" => AccountantLogs::orderBy('created_at', 'DESC')->get()
        ]);
    }


    public function deleteDepartment(Request $request) {
        $department = Departments::find($request->id);
        
        if(empty($department)) {
            return response()->json([
                'status' => 401,
                'message' => 'error'
            ]);
        }

        // Add logs
        $this->saveLogDb->saveLog("Deleted a Department: ".$department->department_name);

        $department->delete();
        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);

    }


    public function addDepartmentPost(Request $request) {
        $dept = new Departments();
        $dept->id = $this->generateId->generate(Departments::class);
        $dept->department_name = $request->dept_name;
        $dept->department_pfp = $request->dept_pfp;

        if($dept->save()) {
            // Add logs
            $this->saveLogDb->saveLog("Added a Department: ".$request->dept_name);

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



    public function editDepartmentPost(Request $request) {
        $dept = Departments::find($request->deptId);
        $dept->department_name = $request->deptName;
        $dept->department_pfp = $request->deptBg;

        if($dept->save()) {
            // Add logs
            $this->saveLogDb->saveLog("Edited a Department: ".$request->oldDeptName);

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
