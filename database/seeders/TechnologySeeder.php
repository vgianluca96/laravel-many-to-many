<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techonologies = ['HTML', 'CSS', 'Javascript', 'VueJs', 'SQL', 'php', 'Laravel'];

        foreach ($techonologies as $technology) {
            $newtechnology = new Technology();
            $newtechnology->name = $technology;
            $newtechnology->slug = Str::slug($technology, '-');
            $newtechnology->save();
        }
    }
}
