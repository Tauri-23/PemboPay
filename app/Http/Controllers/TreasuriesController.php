<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Treasuries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TreasuriesController extends Controller
{
    public function index() {
        return view('index');
    }

    public function loginTreasury() {
        return view('login-admin');
    }


    public function loginAccountantPost(Request $request) {
        $treasury = Treasuries::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        $admin = admin::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if(!$treasury) {
            if(!$admin) {
                return response()->json([
                    'status' => 401,
                    'message' => 'error'
                ]);
            }
            $request->session()->put('logged_Admin', $admin->id);
            return response()->json([
                'status' => 201,
                'message' => 'success admin'
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
