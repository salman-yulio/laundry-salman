<?php

namespace Database\Seeders;

use App\Models\User;
use Guzzle\Http\Promise\Create;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(3)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'Admin01',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345678'),
            'id_outlet' => '1',
            'role' => 'admin'
        ]);
    }
}
