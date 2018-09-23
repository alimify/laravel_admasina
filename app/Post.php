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

    public function authors(){
        return $this->belongsToMany('App\Author');
    }

    public function translators(){
        return $this->belongsToMany('App\Translator');
    }

    public function comments(){
        return $this->belongsToMany('App\Comment');
    }

    public function eightComments(){
        $page = $_REQUEST['page']??1;
        $page = intval($page)*8;
        return $this->hasMany('App\Comment')->latest()->limit($page);
    }

}
