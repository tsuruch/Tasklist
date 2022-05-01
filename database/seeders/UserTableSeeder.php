<?php

namespace Database\Seeders;

use DateTime;
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
                'is_chatgroups_admin' => $i % 4 === 1 ? true:false,
                'is_tasks_admin' => $i % 3 === 1 ? true:false,
                'is_auth_admin' => $i === 1 ? true:false,
                'created_at' =>new DateTime(),
                'updated_at' =>new DateTime(),
                'password' => bcrypt('password'),
                'api_token' => Str::random(60),
            ]);

        }


    }
}
