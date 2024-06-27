<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\StoreChatMessageRequest;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    public function store(StoreChatMessageRequest $request)
    {

        $chatMessage = ChatMessage::create([
            'chat_room_id' => $request->validated('chat_room_id'),
            'content' => $request->validated('message'),
            'user_id' => Auth::id()
        ]);

        event(new MessageSent($chatMessage));

        return response()->json(['message' => $request->input('message')]);
    }
}
