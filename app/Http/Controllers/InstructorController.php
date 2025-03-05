<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
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
            'qualification' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'experience' => 'required|integer|min:0', // Experience in years
            'specialization' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 401);
        }

        // Handling Profile Image Upload
        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }

            $profileImage = time() . '.' . $image->extension();

            $image->storeAs('images/instructor/profile_image', $profileImage, 'public');
        }

        // Store Instructor Data
        $instructor = Instructor::create([
            'user_id' => $user->id,
            'qualification' => $request->qualification,
            'bio' => $request->bio,
            'experience' => $request->experience,
            'specialization' => $request->specialization,
            'profile_image' => $profileImage,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Instructor created successfully',
            'data' => $instructor
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        //
    }

    public function createAnnocment(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'chapter_id' => 'required|exists:chapters,id',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('announcements');
        }

        // Store the announcement
        $announcement = Announcement::create([
            'user_id' => Auth::id(),
            'chapter_id' => $request->chapter_id,
            'content' => $request->content,
            'attachment' => $attachmentPath,
            'comments_count' => 0, // Initially, no comments
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Announcement created successfully',
            'data' => $announcement
        ], 201);
    } 
    public function getAnnouncementsByChapter($chapter_id)
    {
        $announcements = Announcement::where('chapter_id', $chapter_id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json([
            'status' => true,
            'data' => $announcements
        ], 200);
    }
}
