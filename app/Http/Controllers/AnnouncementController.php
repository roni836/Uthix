<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{

    public function createAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:classrooms,id',
            'due_date' => 'nullable|date',
            'attachment_file' => 'nullable|array',
            'attachment_file.*' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $announcement = Announcement::create([
            'instructor_id' => Auth::id(),
            'classroom_id' => $request->classroom_id,
            'title' => $request->title,
            'due_date' => $request->due_date,
            'comments_count' => 0,
        ]);
    
         // Store Multiple Images
         if ($request->hasFile('attachment_file')) {
            foreach ($request->file('attachment_file') as $attachment_file) {
                $fileName = time() . '_' . uniqid() . '.' . $attachment_file->getClientOriginalExtension();
                $attachment_file->storeAs('image/attachments', $fileName, 'public');

                Attachment::create([
                    'announcement_id' => $announcement->id,
                    'attachment_file' => $fileName,
                ]);
            }
        }

    
        return response()->json([
            'status' => true,
            'message' => 'Announcement created successfully',
            'data' => $announcement->load('attachments'), // Load related attachments
        ], 201);
    }
    
    
   
public function getAnnouncementsByClass($classroom_id)
{
    $announcements = Announcement::where('classroom_id', $classroom_id)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return response()->json([
        'status' => true,
        'data' => $announcements
    ], 200);
}

}
