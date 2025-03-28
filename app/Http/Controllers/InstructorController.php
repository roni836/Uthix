<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|max:255',
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|string|in:male,female,other',
            'dob' => 'nullable|date',
            'qualification' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'experience' => 'required|integer|min:0', // Experience in years
            'specialization' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Fetch user data
        $data = User::where('id', $user->id)->first();
    
        // Handle profile image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }
    
            // Generate unique file name
            $profileImage = time() . '.' . $image->extension();
    
            // Store image in public storage
            $image->storeAs('images/instructor', $profileImage, 'public');
    
            // Delete old image if exists
            if ($data->image) {
                Storage::disk('public')->delete('images/instructor/' . $data->image);
            }
    
            // Set new image name
            $data->image = $profileImage;
        }
    
        // Update user details
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'image' => $data->image ?? null, // Save new image name in database
        ]);
    
        // Update instructor details if exists
        $instructor = Instructor::where('user_id', $user->id)->first();
        if ($instructor) {
            $instructor->update([
                'qualification' => $request->qualification,
                'bio' => $request->bio,
                'experience' => $request->experience,
            'specialization' => $request->specialization,
            ]);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
        ], 200);
    }
    

    public function showProfile()
    {
        $user = Auth::user();

        $data = Instructor::with('user')->where('user_id', $user->id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Profile fetched successfully',
            'data' =>  $data,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        //
    }

    public function adminStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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
            ], 422);
        }

        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }

            $profileImage = time() . '.' . $image->extension();

            $image->storeAs('images/instructor/profile_image', $profileImage, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? '123456789'),
            'role' => 'instructor',
        ]);

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
}
