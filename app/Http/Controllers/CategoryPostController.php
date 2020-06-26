<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index(Category $category)
    {
        $posts = $category->posts;

        return inertia()->render('index', [
            'posts' => $posts,
            'categories' => Category::all(),
            'recentPosts' => $posts->take(3),
        ]);
    }
}
