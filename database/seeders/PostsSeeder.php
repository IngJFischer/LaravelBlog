<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Provider\Lorem;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Post::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 30; $i++){
            $c = Category::inRandomOrder()->first();
            $title = Str::random(15);

            Post::create(
                [
                    'title'=> $title,
                    'category_id'=> $c->id,
                    'slug'=>Str::slug($title),
                    'description'=> "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    'content'=> Lorem::paragraphs(2, true),
                    'posted'=> "yes",

                ]);
        }
    }
}
