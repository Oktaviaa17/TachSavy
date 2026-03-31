<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // PENJAGA
        User::create([
            'name' => 'Penjaga',
            'email' => 'penjaga@gmail.com',
            'password' => bcrypt('penjaga123'),
            'role' => 'penjaga',
        ]);

        // USER BIASA (opsional buat testing)
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
    }
}
