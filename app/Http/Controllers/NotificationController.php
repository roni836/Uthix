<?php

namespace App\Http\Controllers;

use App\Models\DeviceToken;
use App\Models\User;
use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function updateDeviceToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $user = Auth::user(); // Get authenticated user

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $user->update(['fcm_token' => $request->fcm_token]); // Corrected method call

        return response()->json(['message' => 'Device token updated successfully']);
    }


    // public function sendNotification(Request $request)
    // {
    //     // Validate the notification request
    //     $validated = $request->validate([
    //         'title' => 'required|string',
    //         'body'  => 'required|string',
    //         // Optionally include extra data as an associative array:
    //         'data'  => 'sometimes|array',
    //     ]);

    //     // Retrieve all device tokens from users
    //     $user = Auth::user(); // Get authenticated user

    //     if (!$user || !$user->fcm_token) {
    //         return response()->json(['error' => 'No FCM token found for the user.'], 400);
    //     }

    //     $deviceToken = $user->fcm_token; // Get the FCM token of the authenticated user

    //     // Prepare the payload for Firebase Cloud Messaging
    //     $payload = [
    //         'registration_ids' => $deviceToken,
    //         'notification'     => [
    //             'title' => $validated['title'],
    //             'body'  => $validated['body'],
    //         ],
    //         'data' => $request->input('data', []),
    //     ];

    //     // Get your Firebase server key from config/services.php (set in your .env)
    //     $serverKey = config('services.firebase.server_key');


    //     // Make a POST request to Firebase Cloud Messaging
    //     $response = Http::withHeaders([
    //         'Authorization' => 'key=' . $serverKey,
    //         'Content-Type'  => 'application/json',
    //     ])->post('https://fcm.googleapis.com/fcm/send', $payload);

    //     dd($serverKey);

    //     return response()->json($response->json());
    // }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $user = Auth::user(); // Get authenticated user

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
        $fcm = $user->fcm_token;

        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }


        $title = $request->title;
        $description = $request->body;
        $projectId = 'uthix-b05f2'; # INSERT COPIED PROJECT ID

        $credentialsFilePath = Storage::path('app/json/file.json');
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();

        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];

        $data = [
            "message" => [
                "token" => $fcm,
                "notification" => [
                    "title" => $title,
                    "body" => $description,
                ],
            ]
        ];
        $payload = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
    }
}
