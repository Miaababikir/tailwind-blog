<?php

namespace App\Http\Controllers\Manage;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->latest()->get();

        return inertia()->render('manage/posts/index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return inertia()->render('manage/posts/create', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $post = auth()->user()->createPost($data);

        // Attaching tag to post if there is any tags on the request
        if ($request->filled('tags')) {
            $post->tags()->attach($data['tags']);
        }

        // Uploading and adding image to post if it was on the request
        if ($request->hasFile('image')) {
            $post->addMedia($request->image)->toMediaCollection('images');
        }

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Created Successfully'
        ]);

        return redirect()->route('manage.posts.index');
    }

    public function edit(Post $post)
    {
        return inertia()->render('manage/posts/edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $post->update($request->only(['title', 'body', 'category_id']));

        // Syncing post tags with request tags
        if ($request->filled('tags')) {
            $post->tags()->sync(json_decode($data['tags']));
        }

        // Clearing old post image and uploading the new one
        if ($request->hasFile('image')) {
            $post
                ->clearMediaCollection('images')
                ->addMedia($request->image)
                ->toMediaCollection('images');
        }

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Updated Successfully'
        ]);

        return redirect()->route('manage.posts.index');
    }
}
