<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@donasiku.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Donatur 1 - Lengkap
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'donatur',
            'phone' => '081234567890',
            'address' => 'Jl. Sudirman No. 45, RT 05/RW 03',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'postal_code' => '12190',
            'identity_number' => '3172010101900001',
            'birth_date' => '1990-01-15',
            'gender' => 'L',
            'occupation' => 'Software Engineer',
            'emergency_contact' => '081234567891',
            'emergency_name' => 'Siti Nurhaliza',
            'is_active' => true,
        ]);

        // Donatur 2 - Lengkap
        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'role' => 'donatur',
            'phone' => '081298765432',
            'address' => 'Jl. Gatot Subroto No. 12, RT 02/RW 01',
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'postal_code' => '40285',
            'identity_number' => '3273010202900002',
            'birth_date' => '1985-05-20',
            'gender' => 'P',
            'occupation' => 'Guru',
            'emergency_contact' => '081298765433',
            'emergency_name' => 'Ahmad Hidayat',
            'is_active' => true,
        ]);

        // Donatur 3 - Lengkap
        User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password123'),
            'role' => 'donatur',
            'phone' => '085678901234',
            'address' => 'Jl. Diponegoro No. 78, RT 08/RW 04',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60231',
            'identity_number' => '3578010303950003',
            'birth_date' => '1995-03-25',
            'gender' => 'L',
            'occupation' => 'Dokter',
            'emergency_contact' => '085678901235',
            'emergency_name' => 'Dewi Lestari',
            'is_active' => true,
        ]);
    }
}
