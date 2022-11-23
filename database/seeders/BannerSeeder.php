<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'Title' => 'Banner1',
            'Content' => 'Test content',
            'Url' => '',
            'DesktopImage' => 'upload/files/mobile_images/dummy.jpg',
            'MobileImage' => 'upload/files/desktop_images/dummy.jpg',
            'Status' => '1',
        ]);
    }
}
