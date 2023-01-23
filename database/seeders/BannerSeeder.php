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
            'Title' => 'Banner 1',
            'Content' => 'Banner 1',
            'Url' => '',
            'OrderBy' => '1',
            'DesktopImage' => 'upload/files/desktop_images/Banner-1.webp',
            'MobileImage' => 'upload/files/mobile_images/Banner-Mobile1.webp',
            'Status' => '1',
        ]);
        DB::table('banners')->insert([
            'Title' => 'Banner 2',
            'Content' => 'Banner 2',
            'Url' => '',
            'OrderBy' => '2',
            'DesktopImage' => 'upload/files/desktop_images/Banner-2.webp',
            'MobileImage' => 'upload/files/mobile_images/Banner-Mobile2.webp',
            'Status' => '1',
        ]);
        DB::table('banners')->insert([
            'Title' => 'Banner 3',
            'Content' => 'Banner 3',
            'Url' => '',
            'OrderBy' => '3',
            'DesktopImage' => 'upload/files/desktop_images/Banner-3.webp',
            'MobileImage' => 'upload/files/mobile_images/Banner-Mobile3.webp',
            'Status' => '1',
        ]);
        DB::table('banners')->insert([
            'Title' => 'Banner 4',
            'Content' => 'Banner 4',
            'Url' => '',
            'OrderBy' => '4',
            'DesktopImage' => 'upload/files/desktop_images/Banner-4.webp',
            'MobileImage' => 'upload/files/mobile_images/Banner-Mobile4.webp',
            'Status' => '1',
        ]);
        // 11
    }
}
