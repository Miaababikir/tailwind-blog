<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
     public function auth_user_can_create_new_post_with_tags()
    {
        $user = $this->login();
        $tags = factory(Tag::class, 3)->create();
        $category = factory(Category::class)->create();

        $this->post('/manage/posts', [
            'title' => 'Post title',
            'body' => 'Post body',
            'category_id' => $category->id,
            'tags' => $tags->pluck('id')
        ]);

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('post_tag', ['post_id' => 1, 'tag_id' => 1]);
        $this->assertDatabaseHas('post_tag', ['post_id' => 1, 'tag_id' => 2]);
        $this->assertDatabaseHas('post_tag', ['post_id' => 1, 'tag_id' => 3]);
    }

    /**
     * @test
     */
    public function auth_user_can_create_new_post_without_tags()
    {
        $user = $this->login();

        $category = factory(Category::class)->create();

        $this->post('/manage/posts', [
            'title' => 'Post title',
            'body' => 'Post body',
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id
        ]);
    }

}

