<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMemeber extends Model 
{

    protected $table = 'group_members';
    public $timestamps = true;
    public $guarded = [];

    public function group()
    {
        return $this->belongsTo('App\Groups', 'group_id');
    }

}