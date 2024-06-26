<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function store(Request $request)
    {
        MessageSent::dispatch('Marcelo', $request->input('message'));

        return response()->json(['message' => $request->input('message')]);
    }
}
