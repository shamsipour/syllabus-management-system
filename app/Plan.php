<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $guarded = [];
    public $hidden = ['id', 'created_at', 'updated_at', 'time_id', 'lesson_id', 'teacher_id'];

    public function time()
    {
        return $this->hasOne(Time::class, 'id', 'time_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'id', 'lesson_id');
    }
}
