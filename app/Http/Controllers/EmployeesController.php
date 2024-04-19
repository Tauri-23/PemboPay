<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function loginPage() {
        return view('UserEmployees.index');
    }

    public function dashboard() {
        return view('UserEmployees.Dashboard.index', ['loggedEmployee' => Employees::find(session('logged_employee'))]);
    }

    public function login(Request $request) {
        $employee = Employees::where('id', $request->userid)->first();

        if(!$employee) {
            return response()->json([
                'status' => 401,
                'message' => 'error'
            ]);
        }
        else {
            $request->session()->put('logged_employee', $employee->id);
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }
}
