<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if (!$students) {
            return response()->json([
                'status' => false,
                'message' => 'No Data found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'students' => $students, // Corrected key name
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'status' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::create([
            'user_id' => $user->id,
            'class' => $request->class,
        ]);
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }
}
