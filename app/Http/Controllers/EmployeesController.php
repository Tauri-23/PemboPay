<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Models\Employees;
use App\Models\timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    protected $generateId;
    public function __construct(IGenerateIdService $generateId) {
        $this->generateId = $generateId;
    }

    public function loginPage() {
        return view('UserEmployees.index');
    }

    public function dashboard() {
        return view('UserEmployees.Dashboard.index', [
            'loggedEmployee' => Employees::find(session('logged_employee')),
            'todayTimeIn' => timesheet::where('employee', session('logged_employee'))
                ->whereDate('created_at', Carbon::now()->toDateString())
                ->first(),
        ]);
    }

    public function timesheet() {
        return view('UserEmployees.Timesheet.index', [
            'loggedEmployee' => Employees::find(session('logged_employee'))
        ]);
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

    public function timeIn(Request $request) {
        $timeInId = $this->generateId->generate(timesheet::class);

        $timein = new timesheet();
        $timein->id = $timeInId;
        $timein->employee = $request->empId;
        $timein->time_in = $request->timein;

        if($timein->save()) {
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

    public function timeOut(Request $request) {
        $timesheet = timesheet::find($request->attendanceId);

        $timesheet->time_out = $request->timeout;

        if($timesheet->save()) {
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
