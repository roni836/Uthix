<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AssignmentAttachment;
use App\Models\AssignmentUpload;
use App\Models\Attachment;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{

    public function createAnnouncement(Request $request)
    {
        $instructorId = Instructor::where('user_id', auth()->id())->value('id');
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'due_date' => 'nullable|date',
            'attachments.*' => 'file|mimes:jpg,png,pdf,docx|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $announcement = Announcement::create([
            'instructor_id' => $instructorId,
            'classroom_id' => $request->classroom_id,
            'title' => $request->title,
            'due_date' => $request->due_date,
            'comments_count' => 0,
        ]);
    
        // Handle File Uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('attachments', 'public');
    
                AssignmentAttachment::create([
                    'announcement_id' => $announcement->id, // Corrected
                    'attachment_file' => $filePath,
                ]);
            }
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Announcement created successfully',
            'data' => $announcement->load('attachments'), // Ensure relationship is defined in the model
        ], 201);
    }
    
   
    public function getAnnouncementsByClass($classroom_id)
    {
        $announcements = Announcement::where('classroom_id', $classroom_id)
            ->orderBy('created_at', 'desc')
            ->with(['attachments', 'classroom', 'instructor']) 
            ->get();
    
        return response()->json([
            'status' => true,
            'data' => $announcements
        ], 200);
    }
    


    public function getInstructorAssignments()
    {
        $instructorId = Instructor::where('user_id', auth()->id())->value('id');
    
        if (!$instructorId) {
            return response()->json([
                'status' => false,
                'message' => 'Instructor not found.',
            ], 404);
        }
    
        $assignments = Announcement::where('instructor_id', $instructorId)
            ->with('attachments') // ✅ सही रिलेशन
            ->orderBy('created_at', 'desc') 
            ->get();
    
        return response()->json([
            'status' => true,
            'total_assignments' => $assignments->count(),
            'assignments' => $assignments,
        ], 200);
    }
    
    public function getSubmissions($assignmentId)
    {
        $assignment = Announcement::with(['uploads.student', 'uploads.attachments'])->find($assignmentId);
    
        if (!$assignment) {
            return response()->json([
                'status' => false,
                'message' => 'Assignment not found.',
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'assignment' => [
                'id' => $assignment->id,
                'title' => $assignment->title,
                'due_date' => $assignment->due_date,
                'total_submissions' => $assignment->uploads->count(),
                'uploads' => $assignment->uploads->map(function ($upload) {
                    return [
                        'id' => $upload->id,
                        'student' => [
                            'id' => $upload->student->id,
                            'name' => $upload->student->name,
                            'profile_image' => $upload->student->profile_image ?? null,
                        ],
                        'submitted_at' => $upload->submitted_at,
                        'status' => $upload->status,
                        'title' => $upload->title,
                        'comment' => $upload->comment,
                        'attachments' => $upload->attachments->map(function ($attachment) {
                            return [
                                'id' => $attachment->id,
                                'file_path' => $attachment->attachment_file,
                            ];
                        }),
                    ];
                }),
            ],
        ], 200);
    }
     
   
}
