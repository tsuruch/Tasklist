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
        $member = [
            'Yamada',
            'Tanaka',
            'Suzuki',
            'Sato',
            'Kawasaki',
            'Tanabe',
            'Tomita',
            'Hayashi',
            'Sumida',
            'Michel',
            'Bob',
            'Emi',
            'Mary',
            'John',
            'Jonny',
            'Chun',
            'Franky',
            'Ichinose',
            'Makino',
            'Branka',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
        ];


        for ($i=1; $i <31 ; $i++) {
            $row = [];
            $row['name'] = 'project'.$i;
            $row['deadline'] = '2022/'.rand(6, 12).'/'.rand(1, 28);
            for ($j=1; $j < 5; $j++) {
                $row['process'.$j] = $member[rand(0, count($member)-1)];
                if ($row['process'.$j]==='') {
                    break;
                }
            }
            $row['detail'] = <<<EOM
            '親譲りの無鉄砲で小供の時から損ばかりしている。小学校に居る時分学校の二階から飛び降りて一週間ほど腰を抜かした事がある。
            なぜそんな無闇をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出していたら、
            同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。弱虫やーい。と囃したからである。小使に負ぶさって帰って来た時、
            おやじが大きな眼をして二階ぐらいから飛び降りて腰を抜かす奴があるかと云ったから、この次は抜かさずに飛んで見せますと答えた。（青空文庫より）
            EOM;

            DB::table('tasks')->insert([$row]);
        }
/*
        DB::table('tasks')->insert([
            'name' => 'project1',
            'deadline' => '2022/4/1',
            'process1' => 'Yamada',
            'process2' => 'Yamada',
            'process3' => 'Yamada',
            'process4' => 'Yamada',
            'detail' => 'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、
            量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、',
        ]);


        DB::table('tasks')->insert([
            'name' => 'project2',
            'deadline' => '2022/4/2',
            'process1' => 'Yamada',
            'process2' => 'Tanaka',
            'detail' => 'ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。
            ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト
            。ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキス',
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
            'detail' => '親譲りの無鉄砲で小供の時から損ばかりしている。小学校に居る時分学校の二階から飛び降りて一週間ほど腰を抜かした事がある。
            なぜそんな無闇をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出していたら、
            同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。弱虫やーい。と囃したからである。小使に負ぶさって帰って来た時、
            おやじが大きな眼をして二階ぐらいから飛び降りて腰を抜かす奴があるかと云ったから、この次は抜かさずに飛んで見せますと答えた。（青空文庫より）',
        ]);
*/
    }
}
