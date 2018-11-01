<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function authors(){
        return $this->belongsToMany('App\Author');
    }

    public function translators(){
        return $this->belongsToMany('App\Translator');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->belongsToMany('App\Comment');
    }

    public function eightComments(){
        return $this->hasMany('App\Comment')->latest()->limit(8);
    }

    public function rate(){
        return $this->hasMany('App\Rating');
    }

}
