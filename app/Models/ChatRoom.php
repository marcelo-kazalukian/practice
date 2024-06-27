<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatRoom extends Model
{
    protected $guarded = [];

    public function messages(): hasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
