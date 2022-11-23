<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Operations',
            'Status' => '1',
        ]);
    }
}
