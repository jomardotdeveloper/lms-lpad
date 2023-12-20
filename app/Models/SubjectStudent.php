<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'contact_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
