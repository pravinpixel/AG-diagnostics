<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'country' => 'India',
            'country_code' => '1',
            'iso_code_two' => '',
            'iso_code_three' => '',
            'status' => '1',
        ]);
    }
}
