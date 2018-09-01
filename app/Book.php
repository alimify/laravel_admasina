<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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

    public function title(){

        return $this->belongsToMany('App\Title')
                      ->where('book_title.language_id',Config::get('websettings.defaultLanguage'));
    }

    public function titles(){
        return $this->belongsToMany('App\Title')->withPivot('language_id');
    }



    public function descriptions(){
        return $this->belongsToMany('App\Description')->withPivot('language_id');
    }

    public function description(){
        return $this->belongsToMany('App\Description')
                     ->where('book_description.language_id',Config::get('websettings.defaultLanguage'));
    }

    public function datalinks(){
        return $this->belongsToMany('App\DataLink')->withPivot('language_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
