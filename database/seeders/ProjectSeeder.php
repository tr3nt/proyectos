<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 10 Projects with Faker
        DB::table('projects')->truncate();
        foreach(range(1, 10) as $index) {
            DB::table('projects')->insert([
                'title' => fake()->word . " " . fake()->word,
                'description' => fake()->text,
                'image' => 'nopic.jpg',
                'public' => fake()->boolean,
                'id_created_by' => mt_rand(1,2)
            ]);
        }
    }
}
