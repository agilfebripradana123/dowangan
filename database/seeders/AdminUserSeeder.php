<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => '',
            'email' => '',
            'password' => Hash::make(''),
            'role' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
