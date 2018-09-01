<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{


    public function books(){
        return $this->belongsToMany('App\book');
    }

    public function posts(){
        return $this->belongsToMany('App\post');
    }

}
