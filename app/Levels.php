<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model 
{

    protected $table = 'levels';
    public $timestamps = true;
    public $guarded = [];
    public function questions()
    {
        return $this->hasMany('App\Questions', 'level_id');
    }

}