<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function show(Post $post)
    {
        return inertia()->render('posts/show', [
            'post' => $post,
        ]);
    }
}
