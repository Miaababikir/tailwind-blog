<?php

namespace App\Http\Controllers\Manage;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return inertia()->render('manage/posts/index');
    }

    public function create()
    {
        return inertia()->render('manage/posts/create', [
            'categories' => Category::all(),
        ]);
    }
}
