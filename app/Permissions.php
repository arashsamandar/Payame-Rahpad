<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{

    public $timestamps = false;

    protected $fillable = ['user_id','access_users','access_contents'];

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }
}
