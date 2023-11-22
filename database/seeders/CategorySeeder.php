<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ["Politic","Food","Travel","Movie","Global News","Cartoon","Music","Electro","Festivals"];
        $arr = [];
        foreach($categories as $category)
        {
            $arr[] = [
                "title" => $category,
                "slug" => Str::slug($category),
                "user_id" => rand(1,2),
                "updated_at" => now(),
                "created_at" => now(),
            ];
        }
        Category::insert($arr);
    }
}
