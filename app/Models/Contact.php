<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
      'first_name',
      'last_name',
      'middle_name',
      'address',
      'is_admin',
      'is_student',
      'is_teacher',
      'user_id',
      'section_id',
      'department_id',
      'profile_picture',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function section()
    {
      return $this->belongsTo(Section::class);
    }

    public function department()
    {
      return $this->belongsTo(Department::class);
    }


    public function getFullNameAttribute()
    {
      return "{$this->first_name} {$this->last_name}";
    }

    public function getTwoLettersAttribute()
    {
        return substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1);
    }

    public function scopeStudent($query)
    {
      return $query->where('is_student', true);
    }

    public function scopeTeacher($query)
    {
      return $query->where('is_teacher', true);
    }

    public function scopeAdmin($query)
    {
      return $query->where('is_admin', true);
    }
}
