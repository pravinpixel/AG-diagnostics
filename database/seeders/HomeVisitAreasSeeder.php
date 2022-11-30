<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class HomeVisitAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $key ='agdpixel';
        // $secret ='p1x3l@agd';
        // $responseHomeVisitArea = Http::withBasicAuth($key,$secret)
        // ->get('https://agdmatrix.dyndns.org/a/Pixel/HomeVisitAreas');
        // $responseHomeVisitArea = json_decode($responseHomeVisitArea);
        insertApiHomeVisitAreaData();


    }
}
