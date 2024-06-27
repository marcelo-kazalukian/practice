<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();

        return view('chat-rooms.index', compact('chatRooms'));
    }

    public function show(ChatRoom $chatRoom)
    {
        return view('chat-rooms.show', compact('chatRoom'));
    }
}
