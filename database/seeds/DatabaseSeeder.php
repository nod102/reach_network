<?php

use Illuminate\Database\Seeder;
use App\Models\Advertiser;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Advertiser::class, 10)->create();
        factory(Tag::class, 10)->create();
        factory(Category::class, 10)->create();
        factory(Advertisement::class, 10)->make()->each(function ($post) {
            $post->advertisers()->associate(Advertiser::inRandomOrder()->first());
            $post->categories()->associate(Category::inRandomOrder()->first());
            $post->save();
        });

    }
}
