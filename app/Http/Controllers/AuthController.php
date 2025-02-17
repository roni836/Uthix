<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // protected $twilio;

    // public function __construct(TwilioService $twilio)
    // {
    //     $this->twilio = $twilio;
    // }
    // // User Registration
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|string|min:10|unique:users',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }
    //     $otp = rand(100000, 999999); // Generate OTP

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password),
    //         'is_verified' => false,
    //     ]);

    //     // Send OTP via Twilio
    //     $this->twilio->sendOtp($request->phone, $otp);

    //     return response()->json([
    //         'message' => 'User registered! OTP sent for verification.',
    //         'otp' => $otp // Remove in production
    //     ], 201);

    //     // return response()->json([
    //     //     'message' => 'User registered successfully!',
    //     //     'user' => $user
    //     // ], 201);
    // }


    // public function verifyOtp(Request $request)
    // {
    //     $request->validate([
    //         'phone' => 'required|string',
    //         'otp' => 'required|numeric'
    //     ]);

    //     // Simulating OTP verification (in real use-case, store OTP in DB)
    //     if ($request->otp != 123456) { // Replace with real OTP validation logic
    //         return response()->json(['error' => 'Invalid OTP'], 400);
    //     }

    //     $user = User::where('phone', $request->phone)->first();

    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }

    //     $user->update(['is_verified' => true]);

    //     return response()->json(['message' => 'Phone verified successfully!']);
    // }


    // // User Login

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255|exists:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $credentials = $request->only('email', 'password');

    //     $user = User::where('email', $credentials['email'])->first();

    //     if (!$user || !Hash::check($credentials['password'], $user->password)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
        
    // }

    // // Get Authenticated User
    // public function profile(Request $request)
    // {
    //     return response()->json($request->user());
    // }

    // // Logout
    // public function logout(Request $request)
    // {
    //     $request->user()->tokens()->delete();

    //     return response()->json(['message' => 'User logged out successfully']);
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:student,instructor,seller,admin',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Set the default role to 'student' if no role is provided
        $role = $request->role ?? 'student'; 
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);
    
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }
    
    

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Add role-based response
        $role = $user->role;
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $role
        ]);
    }
    
    // Get Authenticated User
    public function profile(Request $request)
    {
        return response()->json(auth()->user());
    }
    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }
}
