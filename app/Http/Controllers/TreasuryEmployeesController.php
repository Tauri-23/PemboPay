<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthenticateService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveService;
use App\Models\Barangays;
use App\Models\Cities;
use App\Models\Employees;

class TreasuryEmployeesController extends Controller
{
    protected $loggedService; //service to retrieve logged accountant data
    protected $retrieveDb; // service to retrieve all from specific table in database

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
    }


    //Redirect and setup the datas for the page
    public function employees() {
        return view('UserTreasury.Employees.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'employees' => $this->retrieveDb->retrieve(new Employees)
        ]);
    }

    public function addEmployee() {
        return view('UserTreasury.Employees.addEmployee', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'cities' => $this->retrieveDb->retrieve(new Cities),
            'brgy' => $this->retrieveDb->retrieve(new Barangays)
        ]);
    }
}
