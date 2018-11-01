<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{



    public function books(){
        return $this->hasMany('App\Book');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }


}
