<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CurrentOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_posts')->insert([
            'job_title' => 'TechSales Executive',
            'cityId' => '490',
            'department_id' => '1',
            'experience' => '2',
            'education' => 'Any Degree',
            'job_purpose' => 'This position’s main Role & Responsibility is to operate Radiology Department and conduct tests related to X-Ray/CT/MRI/OPG/MAMMO and maintenance of their respective Department.',
            'responsibilities' => 'Fastest TAT possible for every patient.',
            'posts' => '1',
            'status' => '1',
        ]);
       
    }
}
