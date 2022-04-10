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

        for ($i=1; $i < 31; $i++) {
            DB::table('users')->insert([
                'username' => 'test'.$i,
                'email' => 'test'.$i.'@test',
                'is_admin' =>true,
                'password' => bcrypt('password'),
                'api_token' => Str::random(60),
            ]);

        }


    }
}
