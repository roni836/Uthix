<?php

namespace App\Http\Controllers;

use App\Models\LiveStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;

class LiveStreamController extends Controller
{
    public function join(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|string',
            'share_link' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }

        $liveStream = LiveStream::updateOrCreate(
            ['instructor_id' => Auth::id(), 'status' => 0],
            [
                'share_link' => $request->share_link,
                'room_id' => $request->room_id
            ]
        );


        if (!$liveStream) {
            return response()->json(['message' => 'Live stream not found'], 404);
        }

        return response()->json([
            'message' => 'Successfully joined the live stream',
            'liveStream' => $liveStream,
        ]);
    }

    public function leave()
    {
        LiveStream::where('instructor_id', Auth::id())
            ->where('status', 0)
            ->update(['status' => 1]);

        return response()->json([
            'message' => 'Stream ended successfully',

        ]);
    }

    public function active()
    {
        $liveStream = LiveStream::with('instructor')->where('status', 1)->first();

        if (!$liveStream) {
            return response()->json(['message' => 'No active live stream found'], 404);
        }

        return response()->json([
            'message' => 'Active live stream found',
            'liveStream' => $liveStream,
        ]);
    }

    // public function generateToken(Request $request)
    // {

    //     $appId = (int) env('ZEGO_APP_ID');
    //     $serverSecret = strval(env('ZEGO_SERVER_SECRET'));
    //     $userId = Auth::id();
    //     $effectiveTimeInSeconds = 3600;

    //     $payload = [
    //         'app_id' => $appId,
    //         'user_id' => $userId,
    //         'nonce' => random_int(100000, 999999),
    //         'ctime' => time(),
    //         'expire' => $effectiveTimeInSeconds,
    //     ];

    //     $token = JWT::encode($payload, $serverSecret, 'HS256');

    //     return response()->json([
    //         'app_id' => $appId,
    //         'token' => $token,
    //         'user_id' => $userId,
    //     ]);
    // }

    private function generateToken($userId)
    {
        $appId = (int) env('ZEGO_APP_ID');
        $serverSecret = strval(env('ZEGO_SERVER_SECRET'));
        $effectiveTimeInSeconds = 3600;

        $payload = [
            'app_id' => $appId,
            'user_id' => $userId,
            'nonce' => random_int(100000, 999999),
            'ctime' => time(),
            'expire' => $effectiveTimeInSeconds,
        ];

        $token = JWT::encode($payload, $serverSecret, 'HS256');

        return [$token, $appId];
    }


    public function startClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chapter_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ], 422);
        }

        $userId = Auth::id(); // Automatically fetch authenticated user ID

        [$token, $appId] = $this->generateToken($userId);

        return response()->json([
            'role' => 'instructor',
            'user_id' => $userId,
            'chapter_id' => $request->chapter_id,
            'teacher_name' => Auth::user()->name,
            'token' => $token,
            'app_id' => $appId,
        ]);
    }

    public function joinClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chapter_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ], 422);
        }

        $userId = Auth::id(); // Automatically fetch authenticated user ID
        [$token, $appId] = $this->generateToken($userId);

        return response()->json([
            'role' => 'student',
            'user_id' => $userId,
            'chapter_id' => $request->chapter_id,
            'teacher_name' => Auth::user()->name,
            'token' => $token,
            'app_id' => $appId,
        ]);
    }
}
