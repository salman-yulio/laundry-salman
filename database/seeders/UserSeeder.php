<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'remember_token' => Str::random(10),
                'outlet_id' => '1',
                'role' => 'admin'
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'username' => 'owner',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'remember_token' => Str::random(10),
                'outlet_id' => '1',
                'role' => 'owner'
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'username' => 'kasir',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'remember_token' => Str::random(10),
                'outlet_id' => '1',
                'role' => 'kasir'
            ],
        ];
        DB::table('users')->insert($users);
    }
}
