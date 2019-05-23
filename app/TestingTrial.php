<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestingTrial extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function dataTesting()
    {
        return $this->hasMany('App\DataTesting');
    }

    public function dataTrainings()
    {
        return $this->hasMany('App\DataTraining');
    }

    public function dataTarget()
    {
        return $this->hasMany('App\DataTarget');
    }
}
