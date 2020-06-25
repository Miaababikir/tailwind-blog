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
     public function auth_user_can_mange_his_own_posts()
    {
        $user = $this->login();
        factory(Post::class, 5)->create(['user_id' => $user->id]);
        factory(Post::class, 3)->create();

        $this->get('/manage/posts')
            ->assertSuccessful()
            ->assertHasProp('posts')
            ->assertPropCount('posts', 5);

    }

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

    /**
     * @test
     */
    public function auth_user_can_update_post_with_tags()
    {
        $this->login();

        $tags = factory(Tag::class, 3)->create();
        $newTag = factory(Tag::class, 1)->create();
        $category = factory(Category::class)->create();

        $post = factory(Post::class)->create();
        $post->tags()->attach($tags->pluck('id'));

        $this->put("/manage/posts/$post->id", [
            'title' => 'Post title',
            'body' => 'Post body',
            'category_id' => $category->id,
            'tags' => $newTag->pluck('id')
        ]);

        $this->assertDatabaseHas('posts', [
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseMissing('post_tag', ['post_id' => 1, 'tag_id' => 1]);
        $this->assertDatabaseMissing('post_tag', ['post_id' => 1, 'tag_id' => 2]);
        $this->assertDatabaseMissing('post_tag', ['post_id' => 1, 'tag_id' => 3]);

        $this->assertDatabaseHas('post_tag', ['post_id' => 1, 'tag_id' => $newTag->first()->id]);
    }

    /**
     * @test
     */
    public function auth_user_can_update_post_without_tags()
    {
        $this->login();

        $category = factory(Category::class)->create();

        $post = factory(Post::class)->create();

        $this->put("/manage/posts/$post->id", [
            'title' => 'Post title',
            'body' => 'Post body',
            'category_id' => $category->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'category_id' => $category->id,
        ]);
    }

}

