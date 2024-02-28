<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treasuries;

class AuthController extends Controller
{
    public function login(Request $request) {
        return $request->all();
    }
}
