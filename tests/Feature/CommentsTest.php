<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function auth_user_can_add_comment_to_posts()
    {
        $user = $this->login();

        $post = factory(Post::class)->create();

        $this->post("/posts/$post->id/comments", [
            'body' => 'Comment body'
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'body' => 'Comment body'
        ]);
    }

    /**
     * @test
     */
    public function can_see_all_comments_for_post()
    {
        $post = factory(Post::class)->create();

        $post->comments()->create(factory(Comment::class)->raw(['post_id' => $post->id]));
        $post->comments()->create(factory(Comment::class)->raw(['post_id' => $post->id]));
        $post->comments()->create(factory(Comment::class)->raw(['post_id' => $post->id]));

        $response = $this->get("/posts/$post->id")
            ->assertSuccessful();

        $this->assertArrayHasKey('comments', $response->props()['post']);
        $this->assertCount(3, $response->props()['post']['comments']);
    }
}
