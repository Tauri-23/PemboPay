<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Models\Barangays;
use App\Models\Cities;
use App\Models\Employees;
use App\Models\Holidays;
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

    public function viewProfile($id) {
        return view('UserEmployees.Profile.index', [
            'loggedEmployee' => Employees::find(session('logged_employee')),
            'employee' => Employees::find($id),
            'cities' => Cities::all(),
            'brgys' => Barangays::all(),
            'empId' => $id,
        ]);
    }

    public function timesheet($timeSheetMonth) {
        $timesheets = timesheet::where('employee', session('logged_employee'))->get();
        $holidays = Holidays::all();

        if($timeSheetMonth == 'null') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        }
        else {
            $startDate = Carbon::now()->month($timeSheetMonth)->startOfMonth();
            $endDate = Carbon::now()->month($timeSheetMonth)->endOfMonth();
        }
        $datesInRange = [];

        for($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $datesInRange[] = $date->copy();
        }


        return view('UserEmployees.Timesheet.index', [
            'loggedEmployee' => Employees::find(session('logged_employee')),
            'timesheetDates' => $timesheets,
            'datesInRange' => $datesInRange,
            'holidays' => $holidays,
            'endDate' => $endDate
        ]);
    }


    public function publicAttendance() {
        return view('UserEmployees.publicAttendance');
    }

    public function attendanceExpressPost(Request $request) {
        $message = '';
        $emp = Employees::find($request->empId);
        $timesheet = Timesheet::where('employee', $request->empId)
                      ->whereDate('created_at', Carbon::now()->toDateString())
                      ->first();

        if(!$emp) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Id'
            ]);
        }

        if(!$timesheet) {
            $timesheet = new timesheet;
            $timesheet->id = $this->generateId->generate(timesheet::class);
            $timesheet->employee = $request->empId;
            $timesheet->time_in = $request->timeInOut;

            $message = 'Time in success.';

            if($timesheet->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => $message
                ]);
            }
            else {
                return response()->json([
                    'status', 400,
                    'message' => 'Something went wrong please try again later.'
                ]);
            }
        }

        if($timesheet && $timesheet->time_out == null) {
            $timesheet->time_out = $request->timeInOut;
            $message = 'Time out success.';

            if($timesheet->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => $message
                ]);
            }
            else {
                return response()->json([
                    'status', 400,
                    'message' => 'Something went wrong please try again later.'
                ]);
            }
        }

        if($timesheet && $timesheet->time_out != null) {
            return response()->json([
                'status', 400,
                'message' => 'Attendance Completed Today.'
            ]);
        }
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
