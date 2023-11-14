<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Post;
use Illuminate\Http\File;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $newproject = new Project();
            $newproject->title = $faker->realText(20);
            $newproject->github_link = $faker->url();
            $newproject->internet_link = $faker->url();
            $newproject->description = $faker->realText(200);
            $newproject->slug = Str::slug($newproject->title, '-');
            $newproject->preview = 'https://picsum.photos/400/500?random=' . $i + 1;
            $newproject->save();
        }
    }
}
