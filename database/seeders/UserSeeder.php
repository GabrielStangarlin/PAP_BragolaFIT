<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bragola Admin',
            'email' => 'admin@bragola.com',
            'password' => bcrypt('ginasio123'),
            'isAdmin' => 1,
        ]);
    }
}
