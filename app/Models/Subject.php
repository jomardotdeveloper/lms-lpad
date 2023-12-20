<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'contact_id',
        'section_id',
        'subject_code',
        'number_of_units',
        'subject_description',
    ];


    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subjectTopics()
    {
        return $this->hasMany(SubjectTopic::class);
    }

    public function subjectStudents()
    {
        return $this->hasMany(SubjectStudent::class);
    }
}
