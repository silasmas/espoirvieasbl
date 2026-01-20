<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Silas Mas',
            'email' => 'silasjmas@gmail.com',
            'password' => Hash::make('silasmas'),
        ]);
    }
}
