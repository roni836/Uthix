<?php

namespace App\Http\Controllers;

use App\Models\Announcement; // ✅ Announcement Model
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
    // public function store(Request $request)
    // {
    //     $studentId = Student::where('user_id', auth()->id())->value('id');
    
    //     if (!$studentId) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Student not found for this user!',
    //         ], 400);
    //     }
    
    //     $validator = Validator::make($request->all(), [
    //         'announcement_id' => 'required|exists:announcements,id',
    //         'chapter_id' => 'required|exists:chapters,id',
    //         'attachments.*' => 'required|file|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg',
    //         'title' => 'nullable|string|max:255',
    //         'comment' => 'nullable|string',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 422);
    //     }
    
    //     $assignmentUpload = AssignmentUpload::create([
    //         'announcement_id' => $request->announcement_id,
    //         'student_id' => $studentId,
    //         'chapter_id' => $request->chapter_id,
    //         'submitted_at' => now(),
    //         'title' => $request->title,
    //         'comment' => $request->comment,
    //         'status' => 'pending',
    //     ]);
    
    //     if ($request->hasFile('attachments')) {
    //         foreach ($request->file('attachments') as $file) {
    //             $filePath = $file->store('attachments', 'public');
    
    //             AssignmentAttachment::create([
    //                 'assignment_upload_id' => $assignmentUpload->id,
    //                 'announcement_id' => $request->announcement_id,
    //                 'attachment_file' => $filePath,
    //             ]);
    //         }
    //     }
    
    //     return response()->json([
    //         'message' => 'Assignment uploaded successfully!',
    //         'assignment_upload' => $assignmentUpload->load('attachments'),
    //     ], 201);
    // }
    

    public function uploadAssignment(Request $request, $announcementId)
    {
        $studentId = Student::where('user_id', auth()->id())->value('id');
    
        if (!$studentId) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found for this user!',
            ], 400);
        }
    
        // Ensure the announcement exists
        $announcement = Announcement::find($announcementId);
        if (!$announcement) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid announcement ID!',
            ], 404);
        }
    
        // Validate the request
        $validator = Validator::make($request->all(), [
            'attachments.*' => 'required|file|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        // Create Assignment Upload
        $assignmentUpload = AssignmentUpload::create([
            'announcement_id' => $announcementId,
            'student_id' => $studentId,
            'submitted_at' => now(),
            'title' => $request->title,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);
    
        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('attachments', 'public');
    
                AssignmentAttachment::create([
                    'assignment_upload_id' => $assignmentUpload->id,
                    'announcement_id' => $announcementId,
                    'attachment_file' => $filePath,
                ]);
            }
        }
    
        return response()->json([
            'message' => 'Assignment uploaded successfully!',
            'assignment_upload' => $assignmentUpload->load('attachments'),
        ], 201);
    }

    /**
     * Display the submitted assignments.
     */
    public function viewSubmissions($announcementId)
{
    $announcement = Announcement::with(['uploads.student', 'uploads.attachments', 'uploads.chapter'])
        ->where('id', $announcementId)
        ->first();

    if (!$announcement) {
        return response()->json([
            'status' => false,
            'message' => 'Announcement not found.',
        ], 404);
    }

    return response()->json([
        'status' => true,
        'total_submissions' => $announcement->uploads->count(),
        'uploads' => $announcement->uploads->map(function ($upload) {
            return [
                'id' => $upload->id,
                'student' => $upload->student ? [
                    'id' => $upload->student->id,
                    'name' => $upload->student->name,
                    'profile_image' => $upload->student->profile_image ?? null,
                ] : null, // Handle the case where student is null
                'class' => $upload->chapter->classroom->class_name ?? 'N/A',
                'chapter' => $upload->chapter->title ?? 'N/A',
                'section' => $upload->chapter->section_name ?? 'N/A',
                'submitted_at' => $upload->submitted_at,
                'status' => $upload->status,
                'title' => $upload->title,
                'comment' => $upload->comment,
                'attachments' => $upload->attachments->map(function ($file) {
                    return [
                        'id' => $file->id,
                        'file_name' => basename($file->attachment_file),
                        'file_url' => asset('storage/' . $file->attachment_file),
                    ];
                }),
            ];
        }),
    ], 200);
}

    
}
