<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function show()
    {
        return inertia()->render('posts/show');
    }
}
