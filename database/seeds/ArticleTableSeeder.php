<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Articles;

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('articles')->insert([
            'name' => $faker->articles,
            'preview' => $faker->preview,
            'content' => $faker->content,
            'category_id' => rand(1, $i + 1),
            'image' => null,
            'is_active' => true,
            'url' => $faker->url,
            'user_create_id' => rand(1, $i + 1),
            'user_udpate_id' => rand(1, $i + 1),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
            ]);
        }
    }
}