<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    public function posts(){
        return $this->belongsToMany('App\Post');
    }

    public function books(){
        return $this->belongsToMany('App\Book');
    }
}
