<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    public function users(){
    	return $this->belongsTo('App\Models\User');
    }
}
