<?php

namespace App\Http\Controllers\Manage;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'sometimes',
            'tags.*.id' => 'required_with:tags|exists:tags,id',
        ]);

        $post = auth()->user()->createPost($data);

        if ($request->filled('tags')) {
            $post->tags()->attach($data['tags']);
        }

        session()->flash('success', 'Created successfully');

        return redirect()->route('manage.posts.index');
    }
}
