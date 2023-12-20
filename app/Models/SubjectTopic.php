<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'subject_id',
        'video_src',
        'file_src',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


}
