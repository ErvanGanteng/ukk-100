<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@hearme.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nis' => null,
        ]);

        // Create Student (Optional for testing)
        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@hearme.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'nis' => '12345678',
        ]);

        // Create Categories
        $categories = ['Sarana Fisik', 'Kebersihan', 'Keamanan', 'Fasilitas Lab', 'Lainnya'];
        foreach ($categories as $cat) {
            Kategori::create(['nama_kategori' => $cat]);
        }
    }
}
