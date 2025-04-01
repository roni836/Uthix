<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AssignmentAttachment;
use App\Models\AssignmentUpload;
use App\Models\Attachment;
use App\Models\Chapter;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{

    public function createAnnouncement(Request $request, $chapter_id)
    {
        $instructorId = Instructor::where('user_id', auth()->id())->value('id');

        if (!$instructorId) {
            return response()->json([
                'status' => false,
                'message' => 'Instructor not found'
            ], 404);
        }

        // ✅ Validate Request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date',
            'attachments.*' => 'file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // ✅ Check if Chapter Exists
        if (!Chapter::find($chapter_id)) {
            return response()->json([
                'status' => false,
                'message' => 'Chapter not found'
            ], 404);
        }

        // ✅ Create Announcement
        $announcement = Announcement::create([
            'instructor_id' => $instructorId,
            'chapter_id' => $chapter_id,
            'title' => $request->title,
            'due_date' => $request->due_date,
            'comments_count' => 0,
        ]);

        // ✅ Handle File Uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('attachments', 'public');

                AssignmentAttachment::create([
                    'announcement_id' => $announcement->id,
                    'attachment_file' => $filePath,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Announcement created successfully',
            'data' => $announcement->load('attachments'),
        ], 201);
    }



    // public function getAnnouncementsByClass($chapter_id)
    // {
    //     // Get the instructor along with the user details
    //     $instructor = Instructor::where('user_id', auth()->id())->with('user')->first();
    
    //     if (!$instructor) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Instructor not found.',
    //         ], 404);
    //     }
    
    //     // Fetch announcements for the instructor
    //     $announcements = Announcement::where('chapter_id', $chapter_id)
    //         ->where('instructor_id', $instructor->id) // Filter by instructor ID
    //         ->orderBy('created_at', 'desc')
    //         ->with(['attachments', 'chapter']) // Include user details
    //         ->get();
    //             // dd($instructor);
    
    
    //     return response()->json([
    //         'status' => true,
    //         'instructor_name' => $instructor->user->name, // Fetching instructor's name
    //         'data' => $announcements
    //     ], 200);
    // }

    public function getAnnouncementsByClass($chapter_id)
    {
        // Get the instructor along with the user details
        $instructor = Instructor::where('user_id', auth()->id())->with('user')->first();
    
        if (!$instructor) {
            return response()->json([
                'status' => false,
                'message' => 'Instructor not found.',
            ], 404);
        }
    
        // Fetch the chapter with all announcements
        $chapter = Chapter::where('id', $chapter_id)
            ->with(['announcements' => function ($query) use ($instructor) {
                $query->where('instructor_id', $instructor->id) // Fetch only this instructor's announcements
                    ->orderBy('created_at', 'desc')
                    ->with(['attachments']); 
            }])
            ->first();
    
        if (!$chapter) {
            return response()->json([
                'status' => false,
                'message' => 'Chapter not found.',
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'chapter_title' => $chapter, // Chapter name
            'instructor_name' => $instructor->user->name, // Instructor's name
            // 'data' => $chapter->announcements // Announcements under the chapter
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
    public function getSubmissionsofChapter($chapterId)
    {
        $submissions = AssignmentUpload::where('chapter_id', $chapterId)->with(['student'])->get();

        return response()->json([
            'success' => true,
            'data' => $submissions
        ]);
    }


    public function getChapterAnnouncements($chapter_id)
    {
        $chapter = Chapter::where('id', $chapter_id)
            ->with(['announcements' => function ($query) {
                $query->orderBy('created_at', 'desc')
                    ->with('attachments', 'instructor.user'); 
            }])
            ->first();
    
        if (!$chapter) {
            return response()->json([
                'status' => false,
                'message' => 'Chapter not found.',
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'chapter_title' => $chapter,
            'announcements' => $chapter->announcements->map(function ($announcement) {
                return [
                    'announcement_id' => $announcement->id,
                    'title' => $announcement->title,
                    'description' => $announcement->description,
                    'created_at' => $announcement->created_at->toDateTimeString(),
                    'instructor_name' => $announcement->instructor->user->name,
                    'attachments' => $announcement->attachments
                ];
            })
        ], 200);
    }
}
