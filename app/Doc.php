<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    public function dv(){
        return $this->belongsTo(Dv::class);
    }
}
