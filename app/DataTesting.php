<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTesting extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    // public function testingTrial()
    // {
    //     return $this->belongsTo('App\TestingTrial');
    // }
}
