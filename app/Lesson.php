<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public $timestamps = false;
    public $guarded = [];
    public $appends = ['level_caption'];
    public $hidden = ['id', 'major_id', ];

    public function major()
    {
        return $this->hasOne(Major::class, 'id', 'major_id');
    }

    public function getLevelCaptionAttribute()
    {
        return config('system.MAJOR_LEVELS')[$this->major->level]['name'];
    }
}
