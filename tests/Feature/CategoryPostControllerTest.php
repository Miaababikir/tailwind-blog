<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryPostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_get_all_posts_related_to_category()
    {
        $hasPostsCategory = factory(Category::class)->create();
        $hasNoPostsCategory = factory(Category::class)->create();
        $posts = factory(Post::class, 5)->create(['category_id' => $hasPostsCategory->id]);

        $this->get("/categories/$hasPostsCategory->id/posts")
            ->assertSuccessful()
            ->assertHasProp('posts')
            ->assertPropCount('posts', 5);

        $this->get("/categories/$hasNoPostsCategory->id/posts")
            ->assertSuccessful()
            ->assertHasProp('posts')
            ->assertPropCount('posts', 0);

    }
}
