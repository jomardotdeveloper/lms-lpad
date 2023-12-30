<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
      'topic_id',
    ];

    public function topic()
    {
      return $this->belongsTo(Topic::class);
    }

    public function items()
    {
      return $this->hasMany(Item::class);
    }

    public function testSubmissions()
    {
      return $this->hasMany(TestSubmission::class);
    }
}
