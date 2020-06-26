<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $guarded = [];

    protected $with = ['category', 'tags', 'publisher', 'comments'];

    protected $appends = ['description', 'image'];

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::make($created_at)->diffForHumans();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('images');
    }


    public function getDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->body), 200);
    }
}
