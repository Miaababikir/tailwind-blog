<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $guarded = [];

    protected $with = ['category', 'tags', 'publisher'];

    protected $appends = ['description'];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    public function getDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->body), 200);
    }
}
