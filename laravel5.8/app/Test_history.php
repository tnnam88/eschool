<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_history extends Model
{
    protected $table = 'test_histories';

    public function subjectt()
    {
        return $this->hasOne('App\Subject');
    }
    public function levell()
    {
        return $this->hasOne('App\Level');
    }
}
