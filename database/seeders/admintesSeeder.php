<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class admintesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  User::create ([
            'name' => 'AdminTes',
            'email' => 'adminTes@gmail.com',
            'password' => Hash::make('admin321tes'),
            'role' => 'admin',
        ]);
    }
}
