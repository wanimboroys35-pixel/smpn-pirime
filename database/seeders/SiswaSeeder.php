<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed user
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Panggil seeder lain DI SINI
        $this->call([
            GuruSeeder::class,
            PendaftarSeeder::class,
        ]);
    }
}
