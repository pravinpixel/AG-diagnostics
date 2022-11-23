<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SampleCollectionCentersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $key ='agdpixel';
        $secret ='p1x3l@agd';
        $responseSampleCollectionCenters = Http::withBasicAuth($key,$secret)
        ->get('https://agdmatrix.dyndns.org/a/Pixel/SampleCollectionCenters');
        $responseSampleCollectionCenters = json_decode($responseSampleCollectionCenters);
        $dataSampleCollectionCenters = insertApiSampleCollectionCentersData($responseSampleCollectionCenters);


    }
}
