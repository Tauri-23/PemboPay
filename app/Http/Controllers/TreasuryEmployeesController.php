<?php

namespace App\Http\Controllers;

use App\Contracts\IAuthenticateService;
use App\Contracts\IGenerateIdService;
use App\Contracts\ILoggedService;
use App\Contracts\IRetrieveService;
use App\Models\Barangays;
use App\Models\Cities;
use App\Models\Departments;
use App\Models\Employees;
use Illuminate\Http\Request;

class TreasuryEmployeesController extends Controller
{
    protected $loggedService; //service to retrieve logged accountant data
    protected $retrieveDb; // service to retrieve all from specific table in database
    protected $generateId;

    public function __construct(ILoggedService $loggedService, IRetrieveService $retrieveDb, IGenerateIdService $generateId) {
        $this->loggedService = $loggedService;
        $this->retrieveDb = $retrieveDb;
        $this->generateId = $generateId;
    }


    //Redirect and setup the datas for the page
    public function employees() {

        return view('UserTreasury.Employees.index', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'employees' => Employees::all()
        ]);
    }

    public function addEmployee() {
        return view('UserTreasury.Employees.addEmployee', [
            'loggedTreasury' => $this->loggedService->retrieveLoggedAccountant(session('logged_treasury')),
            'cities' => $this->retrieveDb->retrieve(Cities::class),
            'brgy' => $this->retrieveDb->retrieve(Barangays::class),
            'departments' => $this->retrieveDb->retrieve(Departments::class)
        ]);
    }

    public function addEmployeePost(Request $request) {
        $emp = new Employees();
        $emp->id = $this->generateId->generate(Employees::class);
        $emp->firstname = $request->emp_fname;
        $emp->middlename = $request->emp_mname != null? $request->emp_name : null;
        $emp->lastname = $request->emp_lname;
        $emp->gender = $request->emp_gender;
        $emp->department = $request->emp_department;
        $emp->city = $request->emp_city;
        $emp->barangay = $request->emp_brgy;
        $emp->street_address = $request->emp_st_address;
        $emp->email = $request->emp_email;
        $emp->phone = $request->emp_phone;
        $emp->birth_date = $request->emp_bdate;
        $emp->pfp = "defaultPFP.png";
        $emp->hourly_rate_mode = $request->emp_hrly_mode;

        if($emp->save()) {
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
