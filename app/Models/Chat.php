<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable=[
        'message',
        'conversation_id',
        'user_id',
        'is_read'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsNewAttribute()
    {
        return $this->created_at->format('Y-m-d H:i') == now()->format('Y-m-d H:i');
    }
}
