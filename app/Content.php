<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    public $timestamps = false;

    protected $fillable = ['user_id','title','brief','page_address','input_at','definition','created_at','Begin_at','End_at','is_confirmed','user_message','admin_message'];

    public function users() {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function imageone() {
        return $this->hasMany('App\ImageOne');
    }

    public function imagetwo() {
        return $this->hasMany('App\ImageTwo');
    }

    public function imagethree() {
        return $this->hasMany('App\ImageThree');
    }

    public function messages() {
        return $this->hasOne('App\messages');
    }
}
