<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $fillable = [
        'star', 'student_id', 'course_id'
    ];
}
