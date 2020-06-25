<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $with = ['category', 'tags'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::make($created_at)->diffForHumans();
    }
}
