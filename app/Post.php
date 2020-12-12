<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{ 

    protected $fillable = [
        'title', 'category_id', 'body',
    ];   
     use SoftDeletes;
     use HasSlug;

      public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')       
            ->slugsShouldBeNoLongerThan(50)
            ->usingSeparator('-');



    }

    public function category(){
        return $this->belongsTo('App\category'); 
    }
    public function tags(){
        return $this->belongsToMany('App\Tag'); 
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
