<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function getAllUser(Request $request)
    {
        $query = User::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $users = $query->get();

        return response()->json([
            'message' => 'Users fetched successfully',
            'users' => $users
        ]);
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'type' => 'required|in:text,voice,file',
            'file' => 'nullable|file|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }

        $filePath = null;
        $mimeType = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('chat_uploads', 'public'); // Save file
            $mimeType = $file->getClientMimeType();
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message ?? '',
            'type' => $request->type,
            'file_path' => $filePath,
            'mime_type' => $mimeType,
            'is_read' => false,
        ]);

        return response()->json(['message' => 'Message sent successfully', 'data' => $message]);
    }

    /**
     * Get all messages of the authenticated user (both sent & received)
     */
    // public function getMessages(Request $request)
    // {
    //     $userId = Auth::id();

    //     $query = Message::where(function ($q) use ($userId) {
    //         $q->where('receiver_id', $userId);
    //     })->orderBy('created_at', 'desc')->with(['receiver', 'sender']);

    //     if ($request->has('search')) {
    //         $search = $request->input('search');
    //         $query->where(function ($q) use ($search) {
    //             $q->where('message_body', 'like', '%' . $search . '%')  
    //               ->orWhereHas('receiver', function ($q) use ($search) { 
    //                   $q->where('name', 'like', '%' . $search . '%');  
    //               });

    //         });
    //     }

    //     $messages = $query->get();

    //     // Add file URL if exists
    //     foreach ($messages as $msg) {
    //         if ($msg->file_path) {
    //             $msg->file_url = asset('storage/' . $msg->file_path);
    //         }
    //     }

    //     return response()->json(['messages' => $messages]);
    // }


    public function getMessages(Request $request)
    {
        $userId = Auth::id();
        $search = $request->input('search'); // Get search query from request

        $messages = Message::where(function ($query) use ($userId) {
            $query->where('receiver_id', $userId)
                ->orWhere('sender_id', $userId);
        })->with(['receiver', 'sender']); // Include sender and receiver details

        // Apply search filter if search query is provided
        if (!empty($search)) {
            $messages->where(function ($query) use ($search) {
                $query->where('message', 'LIKE', "%$search%")
                    ->orWhereHas('sender', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('receiver', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        $messages = $messages->orderBy('created_at', 'desc')->get();

        // Add file URL if a file exists
        foreach ($messages as $msg) {
            if ($msg->file_path) {
                $msg->file_url = asset('storage/' . $msg->file_path);
            }
        }

        return response()->json(['messages' => $messages]);
    }


    /**
     * Get conversation between two users
     */
    public function getConversation($receiverId)
    {
        $userId = Auth::id();

        $messages = Message::where(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->with('receiver','sender')->get();

        foreach ($messages as $msg) {
            if ($msg->file_path) {
                $msg->file_url = asset('storage/' . $msg->file_path);
            }
        }

        return response()->json(['messages' => $messages]);
    }

    /**
     * Mark message as read
     */
    public function markAsRead($messageId)
    {
        $message = Message::where('id', $messageId)
            ->where('receiver_id', Auth::id())
            ->firstOrFail();

        $message->update(['is_read' => true]);

        return response()->json(['message' => 'Message marked as read']);
    }

    /**
     * Delete a message (Only sender can delete their messages)
     */
    public function deleteMessage($messageId)
    {
        $message = Message::where('id', $messageId)
            ->where('sender_id', Auth::id())
            ->firstOrFail();

        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
}
