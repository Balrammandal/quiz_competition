<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model 
{

    protected $table = 'questions';
    public $timestamps = true;
    public $guarded = [];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function level()
    {
        return $this->belongsTo('App\Levels', 'level_id');
    }

}