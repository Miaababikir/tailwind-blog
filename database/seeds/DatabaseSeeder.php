<?php

use App\Category;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'test@test.com'
        ]);

        factory(Category::class)->create(['name' => 'Web Development']);
        factory(Category::class)->create(['name' => 'Mobile Development']);
        factory(Category::class)->create(['name' => 'Architecture']);

        factory(Tag::class)->create(['name' => 'Larevel']);
        factory(Tag::class)->create(['name' => 'Vue']);
        factory(Tag::class)->create(['name' => 'React']);
        factory(Tag::class)->create(['name' => 'Tailwind css']);
    }
}
