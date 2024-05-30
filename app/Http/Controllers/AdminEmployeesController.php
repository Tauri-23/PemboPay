<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ISendEmailService;
use App\Models\AccountantLogs;
use App\Models\admin;
use App\Models\Barangays;
use App\Models\Cities;
use App\Models\Departments;
use App\Models\Employees;
use Illuminate\Http\Request;

class AdminEmployeesController extends Controller
{
    protected $generateId;
    protected $emailSender;

    public function __construct(IGenerateIdService $generateId, ISendEmailService $emailSender) {
        $this->generateId = $generateId;
        $this->emailSender = $emailSender;
    }

    public function index() {
        $admin = admin::find(session('logged_Admin'));

        if(!$admin) {
            return redirect('/');
        }

        $employees = Employees::with('department', 'compensation')->get();
        return view('UserAdmin.Employees.index', [
            'employees' => $employees,
        ]);
    }


    public function addEmployee() {
        $departments = Departments::all();
        $brgy = Barangays::all();
        $cities = Cities::all();
        $admin = admin::find(session('logged_Admin'));

        if(!$admin) {
            return redirect('/');
        }

        return view('UserAdmin.Employees.addEmployees', [
            'cities' => $cities,
            'brgy' => $brgy,
            'departments' => $departments,
        ]);
    }
}
