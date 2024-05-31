<?php
namespace App\Services;

use App\Contracts\IGenerateEmpIdService;
use App\Models\Departments;
use App\Models\Employees;
use Carbon\Carbon;

class GenerateEmpIdService implements IGenerateEmpIdService {
    public function generate($departmentId) {
        $nowDate = Carbon::now();
        $monthToday = $nowDate->format('m');
        $yearToday = $nowDate->format('y');

        $department = Departments::find($departmentId);
        $empNum = Employees::where('department', $departmentId)
                           ->whereMonth('created_at', $monthToday)
                           ->whereYear('created_at', $nowDate->format('Y'))
                           ->count();

        $empId = $department->department_tag . '-' . str_pad($empNum + 1, 2, '0', STR_PAD_LEFT) . $monthToday . $yearToday;
    
        return $empId; //Format is Dept Tag-empNum MonthToday YearToday    e.g. AD-010524
    }
}