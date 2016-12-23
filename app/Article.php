<?php

namespace App;

use Carbon\Carbon;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;

class Article extends Model
{
    use LocalizedEloquentTrait;

    protected $fillable = [

        'title', 'content'

    ];

//    public function getRouteKeyName() {
//        return 'slug';
//    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value, "-");
    }

    public function getCreatedAtAttribute($value)
    {
        return LocalizedCarbon::parse($value)->diffForHumans();
    }


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('id')->all();
    }

    //public function setNameAttribute($data) {
    //   $this->attributes['name'] = str_replace([' ', '  ', '-', '--'], ['_', '_', '_', '_'], trim($data));
    //}
}
