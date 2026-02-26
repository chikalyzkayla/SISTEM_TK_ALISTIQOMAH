<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@tkalistiqomah.com',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
        ]);
        
        \App\Models\User::create([
            'name' => 'Guru Siti',
            'email' => 'guru@tkalistiqomah.com',
            'password' => bcrypt('guru123'),
            'role' => 'Guru',
        ]);
        
        \App\Models\User::create([
            'name' => 'Ibu Sri',
            'email' => 'orangtua@tkalistiqomah.com',
            'password' => bcrypt('orangtua123'),
            'role' => 'Orang Tua',
        ]);
    }
}
