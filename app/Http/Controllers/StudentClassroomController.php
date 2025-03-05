<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentClassroomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::find($user->id);

        $students = StudentClassroom::where('student_id',$student->id)->get();

        if (!$students) {
            return response()->json([
                'status' => false,
                'message' => 'No Data found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'students' => $students,
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id',$user->id)->first();

        $validator = Validator::make($request->all(), [
            'status' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = StudentClassroom::create([
            'student_id' => $student->id,
            'classroom_id' => $request->classroom_id,
        ]);
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data created successfully',
            'data' => $student
        ], 201);
    }
}
