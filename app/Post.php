<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{ 

    protected $fillable = [
        'title', 'category_id', 'body',
    ];   
     use SoftDeletes;

    //
    public function category(){
        return $this->belongsTo('App\category'); 
    }
    public function tags(){
        return $this->belongsToMany('App\Tag'); 
    }
}
