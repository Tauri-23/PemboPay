<?php

namespace App\Http\Controllers;

use App\Models\Treasuries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TreasuriesController extends Controller
{
    public function index() {
        return view('index');
    }


    public function login(Request $request) {
        $treasury = Treasuries::where('username', $request->username)
                       ->where('password', $request->password)
                       ->first();
        if(!$treasury) {
            return response()->json([
                'status' => 401,
                'message' => 'error'
            ]);
        }
        else {
            $request->session()->put('logged_treasury', $treasury->id);
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ]);
        }
    }

    public function logout() {
        auth()->logout();
        session()->flush();
        return redirect('/');
    }
}
