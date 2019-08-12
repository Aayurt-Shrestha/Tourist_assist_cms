<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //public $timestamps = true;
     public function tour()
    {
    	return $this->belongsToMany(Tour::class);
    }
}
