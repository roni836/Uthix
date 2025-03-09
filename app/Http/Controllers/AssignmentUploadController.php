<?php

namespace App\Http\Controllers;

use App\Models\AssignmentAttachment;
use App\Models\AssignmentUpload;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentUploadController extends Controller
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
        $studentId = Student::where('user_id', auth()->id())->value('id');

        // ✅ Validation
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:assignments,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'files.*' => 'required|file|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg', // Multiple files
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // ✅ Save Assignment Upload
        $assignmentUpload = AssignmentUpload::create([
            'assignment_id' => $request->assignment_id,
            'student_id' => $studentId,
            'classroom_id' => $request->classroom_id,
            'submitted_at' => now(),
            'title' => $request->title,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

       

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('attachments', 'public'); 
        
                AssignmentAttachment::create([
                    'assignment_upload_id' => $assignmentUpload->id, // ✅ Correct
                    'assignment_id' => $request->assignment_id, // ✅ Correct
                    'attachment_file' => $filePath,
                ]);
            }
        }
    
        return response()->json([
            'message' => 'Assignment uploaded successfully with attachments!',
            'assignment_upload' => $assignmentUpload->load('attachments')
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(AssignmentUpload $assignmentUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignmentUpload $assignmentUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignmentUpload $assignmentUpload)
    {
        //
    }
}
