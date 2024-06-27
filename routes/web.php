<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CHAT
    Route::get('/chat-rooms', [\App\Http\Controllers\ChatRoomController::class, 'index'])->name('chat-rooms.index');
    Route::get('/chat-rooms/{chatRoom}', [\App\Http\Controllers\ChatRoomController::class, 'show'])->name('chat-rooms.show');
    Route::post('/chat-messages', [\App\Http\Controllers\ChatMessageController::class, 'store'])->name('chat-messages.store');
});

require __DIR__.'/auth.php';
