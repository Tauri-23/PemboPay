<?php

namespace App\Http\Controllers;

use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveService;
use App\Models\Departments;
use Illuminate\Http\Request;

class TreasuryDepartmentsController extends Controller
{
    protected $loggedService;
    protected $retrieveDb;

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
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
}
