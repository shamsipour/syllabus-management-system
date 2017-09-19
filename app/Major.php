<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public $timestamps = false;
    public $fillable = ['name', 'level'];
    public $appends = ['level_caption'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'major_id', 'id');
    }
    public function getLevelCaptionAttribute()
    {
        return config('system.MAJOR_LEVELS')[$this->level]['name'];
    }
}
