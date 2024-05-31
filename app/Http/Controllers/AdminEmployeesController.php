<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateEmpIdService;
use App\Contracts\IGenerateFilenameService;
use App\Contracts\IGenerateIdService;
use App\Contracts\ISendEmailService;
use App\Models\AccountantLogs;
use App\Models\admin;
use App\Models\Barangays;
use App\Models\Cities;
use App\Models\department_positions;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\salary_grade;
use Illuminate\Http\Request;

class AdminEmployeesController extends Controller
{
    protected $generateId;
    protected $emailSender;
    protected $generateEmpId;
    protected $generateFilename;

    public function __construct(IGenerateIdService $generateId, ISendEmailService $emailSender, 
        IGenerateEmpIdService $generateEmpId, IGenerateFilenameService $generateFilename) {
            
        $this->generateId = $generateId;
        $this->emailSender = $emailSender;
        $this->generateEmpId = $generateEmpId;
        $this->generateFilename = $generateFilename;
    }

    public function index() {
        $admin = admin::find(session('logged_Admin'));

        if(!$admin) {
            return redirect('/');
        }

        $employees = Employees::with('department', 'department_positions')->get();
        return view('UserAdmin.Employees.index', [
            'employees' => $employees,
        ]);
    }

    public function addEmployee($deptId) {
        $departments = Departments::all();
        $selectedDept = Departments::find($deptId);
        $deptPosition = department_positions::where('department', $deptId)->get();
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
            'selectedDept' => $selectedDept,
            'deptPosition' => $deptPosition
        ]);
    }

    public function viewEmployee($id) {
        $employee = Employees::find($id);
        $admin = admin::find(session('logged_Admin'));
        $cities = Cities::all();
        $brgys = Barangays::all();

        if(!$admin) {
            return redirect('/');
        }

        return view('UserAdmin.Employees.viewEmployee', [
            'employee' => $employee,
            'cities' => $cities,
            'brgys' => $brgys,
        ]);
    }





    public function addEmployeePost(Request $request) {
        $isEmailExis = Employees::where('email', $request->emp_email)->first();

        if($isEmailExis) {
            return response()->json([
                'status' => 400,
                'message' => 'Email already exist.'
            ]);
        }

        // Employee
        $emp = new Employees();
        $emp->id = $this->generateEmpId->generate($request->emp_department);
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
        $emp->position = $request->emp_position;


        if($emp->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Employee added successfully.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }

    }

    public function editEmployeePost(Request $request) {
        $employee = Employees::find($request->emp_id);

        if($request->editType == 'Personal Information') {
            $employee->firstname = $request->fname;
            $employee->middlename = $request->mname;
            $employee->lastname = $request->lname;
            $employee->phone = $request->phone;
            $employee->gender = $request->gender;
        }
        else if($request->editType == 'Address Information') {
            $employee->street_address = $request->street_address;
            $employee->city = $request->city;
            $employee->barangay = $request->brgy;
        }
        else if($request->editType == 'PFP') {
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
    
                $employee->pfp = $newFilename;
    
            } catch(\Exception $ex) {
                return response()->json([
                    'status' => 500,
                    'message' =>'Failed to upload file: ' . $ex->getMessage()
                ]);
            }
        }


        if($employee->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Saved Changes.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }

    }
}
