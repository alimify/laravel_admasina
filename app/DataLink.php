<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLink extends Model
{
    public function lang(){
        return $this->hasOne('App\Language');
    }
}
