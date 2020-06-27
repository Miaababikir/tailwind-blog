<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password',];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime',];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function createPost($post)
    {
        return $this->posts()->create([
            'title' => $post['title'],
            'body' => $post['body'],
            'category_id' => $post['category_id']
        ]);
    }
}
