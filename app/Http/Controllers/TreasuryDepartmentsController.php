<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveIdService;
use App\Contracts\IRetrieveService;
use App\Contracts\IRetrieveWhereService;
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

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb, IRetrieveIdService $retrieveIdDb, IRetrieveWhereService $retrieveWhereDb, IGenerateIdService $generateId) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
        $this->retrieveIdDb = $retrieveIdDb;
        $this->retrieveWhereDb = $retrieveWhereDb;
        $this->generateId = $generateId;
    }

    public function departments() {
        return view('UserTreasury.Departments.index', 
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
        'departments' => Departments::class::all()
        ]);
    }
    

    public function addDepartments() {
        return view('UserTreasury.Departments.addDepartment', 
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }


    public function viewDepartment($id) {
        return view('UserTreasury.Departments.viewDepartment',
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
        'department' => $this->retrieveIdDb->retrieveId(Departments::class, $id),
        'employees' => $this->retrieveWhereDb->retrieveWhere(Employees::class, [['department', '==', $id]])
        ]);
    }


    public function addDepartmentPost(Request $request) {
        $dept = new Departments();
        $dept->id = $this->generateId->generate(Departments::class);
        $dept->department_name = $request->dept_name;
        $dept->department_pfp = $request->dept_pfp;

        if($dept->save()) {
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
