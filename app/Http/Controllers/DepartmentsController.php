<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\Treasuries;

class DepartmentsController extends Controller
{
    public function retrieveLoggedTreasuryData() {
        $logged_id = session('logged_treasury');
        $loggedTreasury = Treasuries::find($logged_id);

        return $loggedTreasury;
    }

    function retrieveDepartments() {
        return Departments::all();
    }

    public function departments() {
        return view('UserTreasury.Departments.index', [
            'loggedTreasury' => $this->retrieveLoggedTreasuryData(),
            'employees'
        ]);
    }
}
