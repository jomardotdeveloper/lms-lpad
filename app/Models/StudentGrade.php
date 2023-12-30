<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $fillable = [
      'student_id',
      'classroom_id',
      'quarter_1',
        'quarter_2',
        'quarter_3',
        'quarter_4',
    ];

    public function student()
    {
      return $this->belongsTo(Contact::class);
    }

    public function classroom()
    {
      return $this->belongsTo(Classroom::class);
    }
}
