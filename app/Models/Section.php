<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable=['name','school_year_id'];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
