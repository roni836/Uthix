<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentAttachment;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
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
        $instructorId = Instructor::where('user_id', auth()->id())->value('id');
     
       
         $validator = Validator::make($request->all(), [
             'title' => 'required|string|max:255',
             'description' => 'nullable|string',
             'classroom_id' => 'required|exists:classrooms,id',
             'due_date' => 'nullable|date',
             'attachments.*' => 'file|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg', // Multiple files validation
         ]);
     
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 422);
         }
     
         // Create Assignment
         $assignment = Assignment::create([
             'title' => $request->title,
             'description' => $request->description,
             'instructor_id' => $instructorId,
             'classroom_id' => $request->classroom_id,
             'due_date' => $request->due_date,
         ]);
     
         if ($request->hasFile('attachments')) {
             foreach ($request->file('attachments') as $file) {
                 $filePath = $file->store('attachments', 'public'); 
     
                 AssignmentAttachment::create([
                     'assignment_id' => $assignment->id, 
                     'attachment_file' => $filePath,
                 ]);
             }
         }
     
         return response()->json([
             'message' => 'Assignment created successfully!',
             'assignment' => $assignment->load('attachments'), 
         ], 201);
     }
     


    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
