<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ISendEmailService;
use App\Models\admin;
use App\Models\department_positions;
use App\Models\Departments;
use App\Models\Employees;
use App\Models\salary_grade;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class AdminDepartmentsController extends Controller
{
    protected $generateId;
    protected $emailSender;

    public function __construct(IGenerateIdService $generateId, ISendEmailService $emailSender) {
        $this->generateId = $generateId;
        $this->emailSender = $emailSender;
    }

    public function index() {
        $departments = Departments::class::all();
        $admin = admin::find(session('logged_Admin'));

        if(!$admin) {
            return redirect('/');
        }

        return view('UserAdmin.Departments.index', [
            'departments' => $departments,
        ]);
    }

    public function addDepartment() {
        return view('UserAdmin.Departments.addDepartment');
    }

    public function viewDepartment($id) {
        $department = Departments::find($id);
        $employees = Employees::with('department', 'department_positions')->where('department', $id)->get();

        return view('UserAdmin.Departments.viewDepartment', [
            'department' => $department,
            'employees' => $employees,
        ]);
    }

    public function departmentSettings($id) {
        $department = Departments::find($id);
        $positions = department_positions::where('department', $id)->get();
        $salGrades = salary_grade::orderBy('value', 'ASC')->get();
        $deptId = $id;

        return view('UserAdmin.Departments.departmentSettings', [
            'department' => $department,
            'positions' => $positions,
            'salGrades' => $salGrades,
            'deptId' => $deptId
        ]);
    }





    public function addDepartmentPost(Request $request) {
        $isTagExist = Departments::where('department_tag', $request->tag)->first();
        $isDeptNameExist = Departments::where('department_name', $request->name)->first();

        if($isTagExist) { 
            return response()->json([
                'status' => 400,
                'message' => 'Department tag already exist.'
            ]);
        }

        if($isDeptNameExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Department name already exist.'
            ]);
        }

        $department = new Departments;
        $department->id = $this->generateId->generate(Departments::class);
        $department->department_name = $request->name;
        $department->department_tag = $request->tag;
        $department->department_pfp = $request->pfp;

        if($department->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Department has been successfully added.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function deleteDepartment(Request $request) {
        $department = Departments::find($request->id);

        if($department->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Department successfully deleted.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }


    public function addDeptPos(Request $request) {
        $isPosExist = department_positions::where('department', $request->dept)->where('position', $request->position)->first();

        if($isPosExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Position already exist.'
            ]);
        }

        $position = new department_positions;
        $position->department = $request->dept;
        $position->position = $request->position;
        $position->salary_grade = $request->salGrade;


        if($position->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Position Added Successfully.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function editDeptPos(Request $request) {
        $isPosExist = department_positions::where('department', $request->dept)
        ->where('position', $request->position)
        ->whereNot('id', $request->id)
        ->first();

        if($isPosExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Position already exist.'
            ]);
        }

        $position = department_positions::find($request->id);
        $position->position = $request->position;
        $position->salary_grade = $request->salGrade;


        if($position->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Position edited successfully.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function delDeptPos(Request $request) {
        $position = department_positions::find($request->id);

        if($position->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Position deleted successfully.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }


    public function editDeptInfo(Request $request) {
        $isNameExist = Departments::where('department_name', $request->name)->whereNot('id', $request->id)->first();

        if($isNameExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Department name already exist.'
            ]);
        }

        $dept = Departments::find($request->id);
        $dept->department_name = $request->name;

        if($dept->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Department name changed successfully.'
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
