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
    public function store(Request $request)
    {
        $studentId = Student::where('user_id', auth()->id())->value('id');

        $validator = Validator::make($request->all(), [
            'announcement_id' => 'required|exists:announcements,id', // ✅ Announcement ka use kiya hai
            'classroom_id' => 'required|exists:classrooms,id',
            'attachments.*' => 'required|file|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg',
            'title' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $assignmentUpload = AssignmentUpload::create([
            'announcement_id' => $request->announcement_id, 
            'student_id' => $studentId,
            'classroom_id' => $request->classroom_id,
            'submitted_at' => now(),
            'title' => $request->title,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        // ✅ File Upload Handling
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('attachments', 'public');

                AssignmentAttachment::create([
                    'assignment_upload_id' => $assignmentUpload->id,
                    'announcement_id' => $request->announcement_id, // ✅ Updated field
                    'attachment_file' => $filePath,
                ]);
            }
        }

        return response()->json([
            'message' => 'Assignment uploaded successfully with attachments!',
            'assignment_upload' => $assignmentUpload->load('attachments'),
        ], 201);
    }

    /**
     * Display the submitted assignments.
     */
    public function viewSubmissions($announcementId)
    {
        $announcement = Announcement::with(['uploads.student', 'uploads.attachments', 'uploads.classroom'])
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
                    'student' => [
                        'id' => $upload->student->id,
                        'name' => $upload->student->name,
                        'profile_image' => $upload->student->profile_image ?? null,
                        'class' => $upload->classroom->class_name ?? 'N/A',
                        'section' => $upload->classroom->section ?? 'N/A',
                    ],
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
