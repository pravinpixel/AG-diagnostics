<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class BrochureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brochures')->insert([
            'title' => 'Package Booklets',
            'brochure' => 'blank.pdf',
            'image' => 'ag_diagnostics.jpg',
            'type' => 'package_booklets',
            'Status' => '1',
        ]);
        DB::table('brochures')->insert([
            'title' => 'Technical Leaflets',
            'brochure' => 'blank.pdf',
            'image' => 'ag_diagnostics.jpg',
            'type' => 'technical_leaflets',
            'Status' => '1',
        ]);
    }
}
