<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('tasks')->insert([
            'name' => 'project1',
            'deadline' => '2022/4/1',
            'process1' => 'Yamada',
            'process2' => 'Yamada',
            'process3' => 'Yamada',
            'process4' => 'Yamada',
        ]);


        DB::table('tasks')->insert([
            'name' => 'project2',
            'deadline' => '2022/4/2',
            'process1' => 'Yamada',
            'process2' => 'Tanaka',
        ]);


        DB::table('tasks')->insert([
            'name' => 'project3',
            'deadline' => '2022/4/5',
        ]);



        DB::table('tasks')->insert([
            'name' => 'project4',
            'deadline' => '2022/5/1',
            'process1' => 'Yanai',
            'process2' => 'Suzuki',
            'process3' => 'Yamamoto',
            'process4' => 'Michel',
        ]);

    }
}
