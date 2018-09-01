<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function titles(){
        return $this->belongsToMany('App\Title')->withPivot('language_id');
    }

    public function title(){

        return $this->belongsToMany('App\Title')
            ->where('post_title.language_id',Config::get('websettings.defaultLanguage'));
    }

    public function descriptions(){
        return $this->belongsToMany('App\Description')->withPivot('language_id');
    }

    public function description(){
        return $this->belongsToMany('App\Description')
            ->where('description_post.language_id',Config::get('websettings.defaultLanguage'));
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }
}
