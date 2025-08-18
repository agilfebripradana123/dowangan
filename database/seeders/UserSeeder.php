<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => '',
            'name' => '',
            'email' => '',
            'password' => Hash::make(''),
            'role' => '',
        ]);
    }
}
