<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Remove foreign constraints
        Schema::disableForeignKeyConstraints();

        $users = [[
            'name' => 'Esaim Najera',
            'email' => 'esaim.najera@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],[
            'name' => 'John Smith',
            'email' => 'john@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]];

        DB::table('users')->truncate();
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        // Project seeder
        $this->call([
            ProjectSeeder::class
        ]);

        // Reassign foreign constraints
        Schema::enableForeignKeyConstraints();
    }
}
