<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dv extends Model
{
   
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function docs(){
        return $this->belongsToMany('App\Doc');
    }

}
