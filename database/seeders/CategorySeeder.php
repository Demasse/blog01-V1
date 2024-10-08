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
        $Categories = collect(  ['livrer', 'jeux-video','film']  )  ;

   $Categories->each(fn ($category) => Category::create([

    'name'=> $category,
    'slug'=>Str::slug($category),
]));
    }
}
