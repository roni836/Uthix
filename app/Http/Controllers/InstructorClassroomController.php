<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\InstructorClassroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstructorClassroomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $instructor = Instructor::where('user_id', $user->id)->first();

        if (!$instructor) {
            return response()->json([
                'status' => false,
                'message' => 'Instructor not found',
            ], 404);
        }

        $classrooms = InstructorClassroom::with(['classroom', 'subject'])
        ->where('instructor_id', $instructor->id)
        ->get();
    
        return response()->json([
            'status' => true,
            'classrooms' => $classrooms,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required|exists:classrooms,id',
            'subject_id' => 'required|exists:subjects,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $classroom = InstructorClassroom::create([
            'classroom_id' => $request->classroom_id,
            'subject_id' => $request->subject_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data saved successfully',
            'classroom' => $classroom
        ], 201);
    }
}
