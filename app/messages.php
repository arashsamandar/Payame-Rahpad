<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','content_id','user_message','admin_message','user_seen','admin_seen'];

    public function contents() {
        return $this->belongsTo('App\Content','content_id','id');
    }
}
