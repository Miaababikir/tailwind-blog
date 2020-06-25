<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Created Successfully'
        ]);

        return redirect()->back();
    }
}
