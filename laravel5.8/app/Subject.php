<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function subjectt()
    {
        return $this->hasMany('App\Test_history');
    }
}
