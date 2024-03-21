<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveService;
use App\Models\Departments;
use Illuminate\Http\Request;

class TreasuryDepartmentsController extends Controller
{
    protected $loggedService;
    protected $retrieveDb;
    protected $generateId;

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb, IGenerateIdService $generateId) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
        $this->generateId = $generateId;
    }

    public function departments() {
        return view('UserTreasury.Departments.index', 
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
        'departments' => $this->retrieveDb->retrieve(new Departments())
        ]);
    }
    

    public function addDepartments() {
        return view('UserTreasury.Departments.addDepartment', 
        ['loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury'))]);
    }


    public function addDepartmentPost(Request $request) {
        $dept = new Departments();
        $dept->id = $this->generateId->generate(new Departments());
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
