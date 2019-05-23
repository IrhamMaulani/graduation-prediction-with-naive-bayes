<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTarget extends Model
{
    public function testingTrial()
    {
        return $this->belongsTo('App\TestingTrial');
    }
}
