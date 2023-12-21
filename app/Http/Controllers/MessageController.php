<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = \App\Models\Conversation::all();
        return view('single-pages.messages' , compact('conversations'));
    }

    public function storeConversation(Request $request)
    {
        $email = $request->email;
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors([
                'errors' => 'User not found.',
            ]);
        }

        $conversation = \App\Models\Conversation::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
        ]);

        return redirect()->route('messages.index', ['special' => 1, 'conversation_id' => $conversation->id])->with('success', 'Conversation started.');
    }

    public function storeChat(Request $request)
    {

        $chat = \App\Models\Chat::create([
            'message' => $request->message,
            'conversation_id' => $request->conversation_id,
            'user_id' => auth()->user()->id,
        ]);
        broadcast(new PusherBroadcast($chat->message, auth()->user()->contact->two_letters,auth()->user()->contact->full_name, $chat->created_at->format('Y-m-d H:i')))->toOthers();

        return [
            'message' => $chat->message,
            'name' => auth()->user()->contact->full_name,
            'date' => $chat->created_at->format('Y-m-d H:i'),
        ];
    }
}
