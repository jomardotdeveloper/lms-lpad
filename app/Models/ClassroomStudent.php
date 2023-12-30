<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    use HasFactory;

    protected $fillable = [
      'classroom_id',
      'student_id',
    ];

    public function classroom()
    {
      return $this->belongsTo(Classroom::class);
    }

    public function student()
    {
      return $this->belongsTo(Contact::class);
    }
}
