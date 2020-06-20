<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learned extends Model
{
    //
    protected $fillable = [
        'student_id', 'lesson_id', 'course_id'
    ];
}
