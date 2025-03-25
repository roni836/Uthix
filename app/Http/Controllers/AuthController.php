<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use Carbon\Carbon;

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
            // 'fcm_token' => 'required|string|max:255',
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
            'fcm_token' => $request->fcm_token ?? '0123456789',
        ]);

        // Generate authentication token
        $token = $user->createToken('auth_token')->plainTextToken;

        // broadcast(new NewMessage('Registration done'))->toOthers();

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $role
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
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        // Check if the user exists
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || $user->role !== 'admin' || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized login attempt'], 401);
        }

        // Log in the admin and generate token
        Auth::login($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token
        ]);
    }


    // Get Authenticated User
    public function profile(Request $request)
    {
        return response()->json(auth()->user());
    }
    // Logout
    // public function logout(Request $request)
    // {
    //     $request->user()->tokens()->delete();
    //     return response()->json(['message' => 'User logged out successfully']);
    // }

    public function logout(Request $request)
    {
        // Delete the token used to authenticate the request
        $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'User logged out successfully']);
    }

    public function forgotPassword(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $email = $request->email;

            // Check if a recent OTP exists (rate limiting - optional)
            $existingOTP = PasswordReset::where('email', $email)
                ->where('created_at', '>=', Carbon::now()->subMinutes(2)) // Prevent multiple requests within 2 minutes
                ->first();

            if ($existingOTP) {
                return response()->json(['message' => 'OTP already sent. Please wait before requesting again.'], 429);
            }

            // Generate 6-digit OTP
            $otp = rand(100000, 999999);

            // Store OTP in the database
            PasswordReset::updateOrCreate(
                ['email' => $email],
                ['otp' => $otp, 'created_at' => Carbon::now()]
            );

            // Send OTP to email
            Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Password Reset OTP');
            });

            return response()->json(['message' => 'OTP sent to your email'], 200);
        } catch (\Exception $e) {
            Log::error('Forgot Password Error: ' . $e->getMessage());
            return response()->json(['message' => 'Something went wrong. Please try again later.'], 500);
        }
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid OTP or email'], 400);
        }

        $otpData = PasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('created_at', '>', Carbon::now()->subMinutes(10)) // OTP valid for 10 mins
            ->first();

        if (!$otpData) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        return response()->json(['message' => 'OTP verified successfully! Proceed to reset password'], 200);
    }

    // Step 3: Reset Password
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid input'], 400);
        }

        $otpData = PasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpData) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        // Update the password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the OTP record
        $otpData->delete();

        return response()->json(['message' => 'Password reset successful!'], 200);
    }
}
