<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function subjectt()
    {
        return $this->hasMany('App\Test_history');
    }
}
