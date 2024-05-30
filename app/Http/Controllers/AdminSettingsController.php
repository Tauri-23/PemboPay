<?php

namespace App\Http\Controllers;

use App\Models\salary_grade;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index() {
        $salGrades = salary_grade::orderBy('value', 'ASC')->get();

        return view('UserAdmin.Settings.index', [
            'salGrades' => $salGrades
        ]);
    }


    public function addSalGradePost(Request $request) {
        $isSalGradeNameExist = salary_grade::where('grade', $request->grade)->first();

        if($isSalGradeNameExist) {
            return response()->json([
                'status' => 400,
                'message' => 'Grade already exist.'
            ]);
        }

        $salGrade = new salary_grade;
        $salGrade->grade = $request->grade;
        $salGrade->value = $request->value;

        if($salGrade->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function editSalGradePost(Request $request) {
        $salGrade = salary_grade::find($request->id);
        $salGrade->grade = $request->grade;
        $salGrade->value = $request->value;

        if($salGrade->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
            ]);
        }
        else {
            return response()->json([
                'status' => 400,
                'message' => 'Something went wrong please try again later.'
            ]);
        }
    }

    public function deleteSalGradePost(Request $request) {
        $salGrade = salary_grade::find($request->id);

        if($salGrade->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Success.'
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
