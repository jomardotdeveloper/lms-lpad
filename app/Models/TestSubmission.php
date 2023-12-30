<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
      'test_id',
      'student_id',
      'item_id',
        'answer',
        'is_correct'
    ];

    public function test()
    {
      return $this->belongsTo(Test::class);
    }

    public function student()
    {
      return $this->belongsTo(Contact::class);
    }

    public function item()
    {
      return $this->belongsTo(Item::class);
    }
}
