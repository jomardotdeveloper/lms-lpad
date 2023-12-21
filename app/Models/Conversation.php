<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable=[
        'is_deleted_from_sender',
        'is_deleted_from_receiver',
        'sender_id',
        'receiver_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    // get user not equal to the current user
    public function getUserNotEqualAttribute()
    {
        if (auth()->user()->id == $this->sender_id) {
            return $this->receiver;
        }
        return $this->sender;
    }

    public function getLastMessageAttribute()
    {
        $last = $this->chats()->latest()->first();

        if ($last) {
            if ($last->user_id == auth()->user()->id) {
                return "You: " . $last->message;
            } else {
                return "{$last->user->contact->first_name}: {$last->message}";
            }
        } else {
            return "No messages yet.";
        }
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
