<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'bishant345@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/bishanta.jpg',
            'role' => 2
        ]);
        DB::table('users')->insert([
            'name' => 'bishant',
            'email' => 'bishant369@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/prabin.PNG',
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'img' => '/img/sanket.jpg',
            'password' => Hash::make('password')
        ]);
        DB::table('users')->insert([
            'name' => 'Jon Doe',
            'email' => 'Jondoe345@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/shaibya.jpg',
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Foo Bar',
            'email' => 'Foobart369@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/prabin.PNG',
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Stefen Curry',
            'email' => 'Setr@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/user1.jpg'
        ]);


        \App\Models\Product::factory(10)->create();



        


    }
}
