<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'type',
      'description',
      'classroom_id',
        'video_src',
        'file_src',
    ];

    public function classroom()
    {
      return $this->belongsTo(Classroom::class);
    }

    public function test()
    {
      return $this->hasOne(Test::class);
    }


}
