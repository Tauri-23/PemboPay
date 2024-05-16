<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    public function index() {
        return view('UserAdmin.index');
    }
}
