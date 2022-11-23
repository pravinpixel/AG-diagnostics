<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_stories')->insert([
            'story_title' => 'Sakaal Times - 2018',
            'date' => '2018-11-10',
            'pdf' => 'dummy.jpg',
            'Status' => '1',
        ]);
        DB::table('feature_stories')->insert([
            'story_title' => 'Loksatta - 2018',
            'date' => '2018-11-10',
            'pdf' => 'dummy.jpg',
            'Status' => '1',
        ]);
        DB::table('feature_stories')->insert([
            'story_title' => 'Saamana - 2018',
            'date' => '2018-11-10',
            'pdf' => 'dummy.jpg',
            'Status' => '1',
        ]);
    }
}
