<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('chat-room.{id}', function ($user, $id) {
    return true;
    // checks if the user belongs to the chat room
    return \App\Models\ChatRoomMember::where('chat_room_id', $id)
        ->where('user_id', $user->id)
        ->exists();
});
