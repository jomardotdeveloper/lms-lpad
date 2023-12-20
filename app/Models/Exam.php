<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_topic_id',
    ];

    public function subjectTopic()
    {
        return $this->belongsTo(SubjectTopic::class);
    }
}
