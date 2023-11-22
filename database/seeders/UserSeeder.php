<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $verify_code = rand(111111,999999);

        User::factory()->create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("password"),
            "role_id" => 3,
            "user_token" => Hash::make($verify_code.strrev($verify_code))
        ]);


        User::factory()->create([
            "name" => "kyaw",
            "email" => "kyaw@gmail.com",
            "password" => Hash::make("password"),
            "role_id" => 2,
            "user_token" => Hash::make($verify_code.strrev($verify_code))
        ]);

    }
}
