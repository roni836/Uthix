<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentPlanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
    
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }
    
        $data = StudentPlan::where('student_id', $student->id)
        ->with(['student', 'plan'])
        ->get();
    
        return response()->json([
            'status' => true,
            'data'=> $data,
        ], 200);
    }
    

    public function store(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();
    
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }
    
        // Validate request data
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'payment_status' => 'required|in:paid,unpaid,refunded'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Check if the student already has a plan
        $studentPlan = StudentPlan::where('student_id', $student->id)->first();
    
        if ($studentPlan) {
            // Update existing plan
            $studentPlan->update([
                'plan_id' => $request->plan_id,
                'payment_status' => $request->payment_status
            ]);
            $message = 'Plan updated successfully';
        } else {
            // Create new plan
            $studentPlan = StudentPlan::create([
                'student_id' => $student->id,
                'plan_id' => $request->plan_id,
                'payment_status' => $request->payment_status
            ]);
            $message = 'Plan created successfully';
        }
    
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $studentPlan
        ], 201);
    }
    

    public function showStudentPlan()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $studentPlan = StudentPlan::where('student_id', $student->id)
        ->with(['student', 'plan'])
        ->first();
        
        if (!$studentPlan) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $studentPlan
        ], 200);
    }
}
