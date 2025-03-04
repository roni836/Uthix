<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ZoomController extends Controller
{
    protected $client;
    protected $baseUrl = 'https://api.zoom.us/v2/';

    public function __construct()
    {
        $this->client = new Client();
    }

    // Function to get Access Token

    public  function getAccessToken()
    {
        $client = new Client();

        $response = $client->post('https://zoom.us/oauth/token', [
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => env('ZOOM_ACCOUNT_ID'),
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET')),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }


    // Function to Create Meeting
    public function createMeeting()
    {
        $token = $this->getAccessToken();
        $client = new Client();

        $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token['access_token'],
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'topic'      => 'Laravel Zoom Meeting',
                'type'       => 2, // Scheduled Meeting
                'start_time' => now()->addMinutes(10)->toIso8601String(), // 10 minutes ahead
                'duration'   => 30,
                'timezone'   => 'Asia/Kolkata',
                'agenda'     => 'Laravel Integration Test',
                'settings'   => [
                    'host_video'        => true,
                    'participant_video' => true,
                    'join_before_host'  => true,
                    'mute_upon_entry'   => true,
                    'watermark'         => true,
                    'audio'             => 'voip',
                    'auto_recording'    => 'cloud',  // Auto Recording
                    'approval_type'     => 0, // No registration required
                    'waiting_room'      => false
                ],
            ],
        ]);

        $meetingData = json_decode($response->getBody(), true);

        return response()->json([
            'meeting_id'  => $meetingData['id'],
            'start_url'   => $meetingData['start_url'],  // Host Start URL
            'join_url'    => $meetingData['join_url'],   // Participants Join URL
            'password'    => $meetingData['password'] ?? null,
        ]);
    }
}
