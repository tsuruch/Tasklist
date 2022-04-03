<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'username' => 'test1',
            'email' => 'test1@test',
            'is_admin' =>true,
            'password' => bcrypt('password'),
            'api_token' => Str::random(60),
        ]);

        DB::table('users')->insert([
            'username' => 'test2',
            'email' => 'test2@test',
            'is_admin' =>true,
            'password' => bcrypt('password'),
            'api_token' => Str::random(60),
        ]);

    }
}
