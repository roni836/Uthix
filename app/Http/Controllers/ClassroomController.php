<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Instructor;
use App\Models\Student;
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
            $instructorId = Instructor::where('user_id', auth()->id())->value('id');
        
            if (!$instructorId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Instructor not found'
                ], 404);
            }
        
            $classrooms = Classroom::where('instructor_id', $instructorId)->get();
        
            return response()->json([
                'status' => true,
                'message' => 'Classrooms fetched successfully',
                'data' => $classrooms
            ], 200);
        }
                
    


    public function allClassroom()
    {
        $user = Auth::user();
        $classrooms = Classroom::with('instructor')->get();

        if (!$classrooms) {
            return response()->json([
                'status' => false,
                'message' => 'No Data found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'classrooms' => $classrooms, // Corrected key name
        ], 200);
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



    // public function createNewChapter(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'classroom_id' => 'required|exists:classrooms,id',
    //         'title' => 'required|string|max:255',
    //         'date' => 'nullable|date',
    //         'time' => 'nullable',
    //         'timezone' => 'nullable|string|max:50',
    //         'repeat_days' => 'nullable|array',
    //         'reminder_time' => 'nullable|integer|min:0',
    //         'description' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->messages(),
    //         ], 422);
    //     }

    //     $class = Chapter::create([
    //         'classroom_id' => $request->classroom_id,  
    //         'title' => $request->title,               
    //         'date' => $request->date,                 
    //         'time' => $request->time,                 
    //         'timezone' => $request->timezone,          
    //         'repeat_days' => json_encode($request->repeat_days), 
    //         'reminder_time' => $request->reminder_time ?? 1, 
    //         'description' => $request->description,   
    //     ]);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Class created successfully',
    //         'data' => $class
    //     ], 201);
    // }

    public function createNewChapter(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i:s', // Ensure correct format
            'timezone' => 'nullable|string|max:50',
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

        // Ensure the classroom exists
        if (!Classroom::find($classroom_id)) {
            return response()->json([
                'status' => false,
                'message' => 'Classroom not found'
            ], 404);
        }

        // Create the Chapter
        $chapter = Chapter::create([
            'classroom_id' => $classroom_id,
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'timezone' => $request->timezone,
            'repeat_days' => json_encode($request->repeat_days ?? []),
            'reminder_time' => $request->reminder_time ?? 1,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Chapter created successfully',
            'data' => $chapter
        ], 201);
    }


    public function manageClasses()
    {
        $user = Auth::user();

        // Step 1: Get the Instructor ID from User
        $instructorId = Instructor::where('user_id', $user->id)->value('id');

        if (!$instructorId) {
            return response()->json([
                'status' => false,
                'message' => 'Instructor not found'
            ], 404);
        }

        // Step 2: Fetch all Chapters related to Instructor's Classrooms
        $chapters = Chapter::whereHas('classroom', function ($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })
            ->with(['classroom.subject']) // Fetch classroom and subject data
            ->get();

        if ($chapters->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No chapters found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $chapters
        ]);
    }



    public function subjectClasses($subject_id)
    {
        $classes = Chapter::whereIn('classroom_id', function ($query) use ($subject_id) {
            $query->select('id')
                ->from('classrooms')
                ->where('subject_id', $subject_id);
        })
            ->with(['classroom.instructor.user'])
            ->with(['classroom.subject'])
            ->get();

        return response()->json([
            'status' => true,
            'data' => $classes
        ]);
    }

}
