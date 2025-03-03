<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'instructor_id' => 'required|exists:instructors,id',
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer|min:1',
            // 'status' => 'required|in:active,inactive',
            'schedule' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ], 422);
        }

        $classroom = Classroom::create([
            'instructor_id' => $request->instructor_id,
            'class_name' => $request->class_name,
            'section' => $request->section,
            'subject_id' => $request->subject_id,
            'link' => $request->link,
            'description' => $request->description,
            'capacity' => $request->capacity ?? 30,
            // 'status' => $request->status,
            'schedule' => $request->schedule,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Classroom created successfully',
            'data' => $classroom
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }



    public function createNewClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'timezone' => 'required|string|max:50',
            'repeat_days' => 'nullable|array',
            'reminder_time' => 'nullable|integer|min:0',
            'description' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ], 422);
        }
    
        $class = ClassModel::create([
            'classroom_id' => $request->classroom_id,  
            'title' => $request->title,               
            'date' => $request->date,                 
            'time' => $request->time,                 
            'timezone' => $request->timezone,          
            'repeat_days' => json_encode($request->repeat_days), 
            'reminder_time' => $request->reminder_time ?? 1, 
            'description' => $request->description,   
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Class created successfully',
            'data' => $class
        ], 201);
    }
    
}
