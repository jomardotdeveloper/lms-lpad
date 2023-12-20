<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'is_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    public function scopeUserLog($query)
    {
        return $query->where('is_admin', false);
    }
}
