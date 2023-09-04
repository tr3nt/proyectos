<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Esaim Najera',
            'email' => 'esaim.najera@gmail.com',
            // Encrypted password
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
