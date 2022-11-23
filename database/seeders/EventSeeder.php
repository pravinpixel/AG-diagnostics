<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_events')->insert([
            'event_name' => 'AG Diagnostics Invites Franchisees For Its Network Of Collection Centers Across Pune',
            'type' => '',
            'start' => '2018-11-10',
            'description' => 'In the year 1978, a young doctor- Dr. Ajit Golwilkar, dreamt of bringing world class pathology services to the city of Pune & founded his pathology laboratory on Karve Road, called Golwilkar Laboratories. His name has been considered as synonymous with quality laboratory services in Pune & the country for four over decades now. To begin with, the samples used to test with the then available basic diagnostic techniques, none the less maintaining highest accuracy and reliability. His endeavour had been to deliver results in shortest possible time and yet at affordable cost',
            'choose' => '',
            'news_image' => '',
            'photo' => 'dummy.jpg',
            'mobile_image' => 'dummy.jpg',
            'video_url' => '',
            'news_url' => '',
            'event_image' => '',
            'meta_title' => 'News Event',
            'meta_keyword' => 'News Event',
            'meta_description' => 'News Event',
            'status' => '1',
        ]);
    }
}
