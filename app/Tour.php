<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
	public $timestamps = false;
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
