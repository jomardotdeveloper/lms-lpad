<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'description',
      'code',
      'teacher_id',
      'image_src'
    ];

    public function teacher()
    {
      return $this->belongsTo(Contact::class, 'teacher_id');
    }

    public function topics()
    {
      return $this->hasMany(Topic::class);
    }

    public function students()
    {
      return $this->belongsToMany(Contact::class, 'classroom_students', 'classroom_id', 'student_id');
    }

    public function studentGrades()
    {
      return $this->hasMany(StudentGrade::class);
    }
}
