<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{



    public function books(){
        return $this->belongsToMany('App\Book');
    }

    public function posts(){
        return $this->belongsToMany('App\Post');
    }


}
