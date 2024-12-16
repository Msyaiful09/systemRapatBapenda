<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nip' => 'admin123',
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
