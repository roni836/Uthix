<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if (!$students) {
            return response()->json([
                'status' => false,
                'message' => 'No Data found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'students' => $students, // Corrected key name
        ], 200);
    }
    public function getAllSubject()
    {
        $subject = Subject::all();

        if (!$subject) {
            return response()->json([
                'status' => false,
                'message' => 'No Data found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'subject' => $subject, // Corrected key name
        ], 200);
    }

    // public function store(Request $request)
    // {
    //     $user = Auth::user();

    //     $validator = Validator::make($request->all(), [
    //         'status' => 'nullable|boolean'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $student = Student::create([
    //         'user_id' => $user->id,
    //         'class' => $request->class,
    //     ]);
    //     if (!$student) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Data not found'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Student created successfully',
    //         'data' => $student
    //     ], 201);
    // }


   public function store(Request $request)
{
    $user = Auth::user();

    // Validation
    $validator = Validator::make($request->all(), [
        'classroom_id' => 'required|exists:classrooms,id',
        'status' => 'nullable|boolean',
        'stream' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    // Check if student already exists
    if (Student::where('user_id', $user->id)->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'Student profile already exists. You can only edit or delete it.'
        ], 409); // Conflict
    }

    // Create student
    $student = Student::create([
        'user_id' => $user->id,
        'classroom_id' => $request->classroom_id,
        'stream' => $request->stream,
        'status' => $request->boolean('status', true), // default true
    ]);

    // Eager load classroom for response
    $student->load('classroom');

    return response()->json([
        'success' => true,
        'message' => 'Student profile created successfully',
        'data' => $student
    ], 201);
}



    public function adminStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'class' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? '123456789'),
            'role' => 'student',
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'class' => $request->class,
        ]);
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6|max:255',
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|string|in:male,female,other',
            'dob' => 'nullable|date',
            'stream' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = User::where('id', $user->id)->first();

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }

            // Generate unique file name
            $profileImage = time() . '.' . $image->extension();

            // Store image in public storage
            $image->storeAs('images/student', $profileImage, 'public');

            // Delete old image if exists
            if ($data->image) {
                Storage::disk('public')->delete('images/student/' . $data->image);
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

        // Update student details if exists
        $student = Student::where('user_id', $user->id)->first();
        if ($student) {
            $student->update([
                'classroom_id' => $request->classroom_id,
                'stream' => $request->stream,
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

        $data = Student::with(['user', 'classroom'])->where('user_id', $user->id)->firstOrFail();
        return response()->json([
            'status' => true,
            'message' => 'Profile fetched successfully',
            'data' =>  $data,
        ], 200);
    }
}
