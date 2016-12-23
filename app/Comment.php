<?php

namespace App;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
class Comment extends Model
{

    use LocalizedEloquentTrait;

    protected $fillable = [

       'article_id', 'comment'

    ];

    public function getCreatedAtAttribute($value)
    {
        return LocalizedCarbon::parse($value)->diffForHumans();
    }

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
