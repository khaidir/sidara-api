<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Khaidir Hasan',
            'email' => 'khaidirhasan@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // ProgressUnduhanRaporSeeder
        $this->call(ProgressUnduhanRaporSeeder::class);
        $this->call(DetailUserAktifSeeder::class);
    }
}