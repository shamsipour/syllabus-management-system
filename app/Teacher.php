<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;
    public $guarded = [];
    public $hidden = ['mobile', 'email'];
    public $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->name." ".$this->family;
    }
}
